<?php

namespace App\Models;

use App\Enums\UserGender;
use App\Enums\GraduationStatus;
use App\Traits\HasFormattedTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Student
 *
 * @property int $id
 * @property int $user_id
 * @property string $nis
 * @property string $fullname
 * @property \Illuminate\Support\Carbon|null $date_of_birth
 * @property UserGender $gender
 * @property string $address
 * @property string $phone_number
 * @property string $mother_name
 * @property GraduationStatus $graduation_status
 *
 * @property-read User $user
 * @property-read StudentGuardian|null $guardian
 * @property-read \Illuminate\Database\Eloquent\Collection<ClassroomStudent> $classroomStudents
 * @property-read ClassroomStudent|null $activeClassroomStudent
 *
 * @property-read string|null $formatted_date_of_birth
 * @property-read string|null $date_of_birth_for_input
 */
class Student extends Model
{
    use HasFactory, HasFormattedTimestamps;

    /**
     * Mass assignable attributes
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nis',
        'fullname',
        'date_of_birth',
        'gender',
        'address',
        'phone_number',
        'mother_name',
        'graduation_status',
    ];

    /**
     * Attribute casting
     *
     * @var array<string, string|\UnitEnum>
     */
    protected $casts = [
        'date_of_birth'     => 'date',
        'gender'            => UserGender::class,
        'graduation_status' => GraduationStatus::class,
    ];

    /**
     * Booted model events
     *
     * Saat student dihapus:
     * - otomatis hapus guardian + user guardian
     * - otomatis hapus akun user student
     */
    protected static function booted(): void
    {
        static::deleting(function (Student $student) {
            // Hapus wali siswa + user-nya
            if ($student->guardian) {
                $student->guardian->delete(); // trigger hook di StudentGuardian
            }

            // Hapus akun siswa
            $student->user?->delete();
        });
    }

    /* ============================================================
     |  Relationships
     |============================================================
     */

    /**
     * Relasi ke akun User (1 siswa -> 1 user)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke wali siswa (1 siswa -> 1 wali)
     */
    public function guardian(): HasOne
    {
        return $this->hasOne(StudentGuardian::class);
    }

    /**
     * Relasi ke ClassroomStudent (1 siswa -> banyak kelas berdasarkan tahun ajaran)
     */
    public function classroomStudents(): HasMany
    {
        return $this->hasMany(ClassroomStudent::class);
    }

    /**
     * Relasi ke ClassroomStudent khusus tahun ajaran aktif
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function activeClassroomStudent(): HasOne
    {
        $activeYear = SchoolYear::getActive();

        return $this->hasOne(ClassroomStudent::class)
            ->where('school_year_id', $activeYear?->id);
    }

    /* ============================================================
     |  Accessors
     |============================================================
     */

    /**
     * Format tanggal lahir untuk tampilan (d M Y)
     */
    public function getFormattedDateOfBirthAttribute(): ?string
    {
        return $this->date_of_birth?->format('d M Y');
    }

    /**
     * Format tanggal lahir untuk input form (Y-m-d)
     */
    public function getDateOfBirthForInputAttribute(): ?string
    {
        return $this->date_of_birth?->format('Y-m-d');
    }
}
