<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'nipd' => strtoupper($this->faker->bothify('NIPD###')),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'nisn' => $this->faker->numerify('##########'),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'nik' => $this->faker->numerify('################'),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            'alamat' => $this->faker->address(),
            'rt' => $this->faker->numerify('##'),
            'rw' => $this->faker->numerify('##'),
            'kecamatan' => $this->faker->city(),

            'ayah_nama' => $this->faker->name('male'),
            'ayah_tahun_lahir' => $this->faker->year(),
            'ayah_pendidikan' => $this->faker->randomElement(['TK', 'SD', 'SMP', 'SMA', 'D1', 'D3', 'D4', 'S1', 'S2', 'S3']),
            'ayah_pekerjaan' => $this->faker->jobTitle(),
            'ayah_penghasilan' => $this->faker->numberBetween(0, 10000000),
            'ayah_nik' => $this->faker->numerify('################'),

            'ibu_nama' => $this->faker->name('female'),
            'ibu_tahun_lahir' => $this->faker->year(),
            'ibu_pendidikan' => $this->faker->randomElement(['TK', 'SD', 'SMP', 'SMA', 'D1', 'D3', 'D4', 'S1', 'S2', 'S3']),
            'ibu_pekerjaan' => $this->faker->jobTitle(),
            'ibu_penghasilan' => $this->faker->numberBetween(0, 10000000),
            'ibu_nik' => $this->faker->numerify('################'),

            'wali_nama' => null,
            'wali_tahun_lahir' => null,
            'wali_pendidikan' => null,
            'wali_pekerjaan' => null,
            'wali_penghasilan' => null,
            'wali_nik' => null,

            'kelas_saat_ini' => $this->faker->randomElement(['7A', '7B', '8A', '8B']),
        ];
    }
}
