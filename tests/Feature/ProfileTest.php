<?php

namespace Tests\Feature;

use App\Models\User;
use App\Modules\Pengguna\Models\Pengguna;
use App\Modules\Role\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
    }

    public function test_student_profile_displays_pengguna_name_and_identity(): void
    {
        $pengguna = $this->createPengguna('Siswa');

        $this->actingAs($pengguna, 'pengguna')
            ->get('/profile')
            ->assertOk()
            ->assertSee('Nama')
            ->assertSee('Siswa Contoh')
            ->assertSee('NIS')
            ->assertSee('12345')
            ->assertSee('NISN')
            ->assertSee('1234567890')
            ->assertSee('Kelas')
            ->assertSee('7A')
            ->assertDontSee('Username');
    }

    public function test_pengguna_can_upload_a_profile_photo(): void
    {
        Storage::fake('public');
        $pengguna = $this->createPengguna('Siswa');

        $this->actingAs($pengguna, 'pengguna')
            ->patch('/profile', [
                'foto_profil' => UploadedFile::fake()->image('avatar.jpg'),
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $photoPath = $pengguna->refresh()->foto_profil;

        $this->assertNotEmpty($photoPath);
        Storage::disk('public')->assertExists($photoPath);

        $this->get('/profile')
            ->assertOk()
            ->assertSee(asset('storage/'.$photoPath), false);
    }

    private function createPengguna(string $roleName): Pengguna
    {
        $role = Role::query()->create([
            'id' => (string) Str::uuid(),
            'role' => $roleName,
            'level' => $roleName === 'Siswa' ? 3 : 2,
        ]);

        return Pengguna::query()->create([
            'id' => (string) Str::uuid(),
            'role_id' => $role->id,
            'nama' => 'Siswa Contoh',
            'email' => 'siswa@example.test',
            'password' => 'password',
            'nis' => 12345,
            'nisn' => 1234567890,
            'jenis_kelamin' => 'L',
            'kelas' => '7A',
            'no_hp' => '081234567890',
        ]);
    }

    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $user->refresh();

        $this->assertSame('Test User', $user->name);
        $this->assertSame('test@example.com', $user->email);
        $this->assertNull($user->email_verified_at);
    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'email' => $user->email,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $this->assertNotNull($user->refresh()->email_verified_at);
    }

    public function test_user_can_delete_their_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete('/profile', [
                'password' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertTrue($user->fresh()->trashed());
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->delete('/profile', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/profile');

        $this->assertNotNull($user->fresh());
    }
}
