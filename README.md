# Laravel Boilerplate - Service + Repository Pattern

Project Laravel ini adalah boilerplate yang gue pake untuk development dengan pattern **Service Layer + Repository Layer**. Tujuannya simpel: struktur yang konsisten, kode yang gampang di-maintain, dan scalable buat project yang mulai gede.

## Kenapa Pake Pattern Ini?

Karena gue butuh:

-   Pemisahan tanggung jawab yang jelas (controller, service, repository)
-   Business logic yang nggak berantakan
-   Kode yang gampang di-test
-   Developer baru (atau AI assistant) bisa langsung paham flow-nya

## Arsitektur Flow

```
Route → Controller → Form Request → Service → Repository → Model → Database
```

### Penjelasan Singkat:

-   **Controller**: Nerima request, manggil service, return response. That's it. No query, no logic.
-   **Form Request**: Validasi input pake Laravel Form Request (`php artisan make:request`)
-   **Service**: Tempat semua business logic, perhitungan, dan rules aplikasi
-   **Repository**: Handle semua query database, join, pagination, dll
-   **Model**: Cuma relasi sama attribute, nggak ada logic

## Struktur Folder

```
app/
├── Http/
│   ├── Controllers/        # Thin controllers
│   └── Requests/           # Form validation
├── Models/                 # Eloquent models
├── Services/               # Business logic layer
├── Repositories/           # Database access layer
└── Providers/              # Service providers
```

## Quick Example

### Controller (Thin & Clean)

```php
public function store(StorePasienRequest $request, PasienService $service)
{
    $service->create($request->validated());
    return redirect()->back()->with('success', 'Data berhasil disimpan');
}
```

### Service (Business Logic)

```php
public function create(array $data): Pasien
{
    // Business logic di sini
    if ($this->isDuplicate($data['email'])) {
        throw new Exception('Email sudah terdaftar');
    }

    return $this->repository->store($data);
}
```

### Repository (Database Access)

```php
public function store(array $data): Pasien
{
    return Pasien::create($data);
}

public function findById(int $id): ?Pasien
{
    return Pasien::find($id);
}
```

## Rules yang WAJIB Diikuti

### ✅ DO:

-   Pake Dependency Injection di constructor
-   Type hinting & return type
-   Validasi pake Form Request
-   Business logic di Service
-   Query database di Repository
-   Follow PSR-12

### ❌ DON'T:

-   Query database di Controller
-   Business logic di Controller
-   Logic di Model (fat model)
-   Bikin helper function global sembarangan
-   Validasi di Controller
-   `new ClassName()` → pake DI!

## Penamaan File

Format: `<Entity><Type>.php`

Contoh:

-   `UserService.php`
-   `PasienRepository.php`
-   `StorePasienRequest.php`
-   `TransaksiController.php`

## Notes

Boilerplate ini dibuat dengan tujuan supaya setiap developer (atau AI assistant) yang kerja di project ini bisa langsung paham flow-nya tanpa ribet. Struktur ini udah terbukti enak buat di-scale dan di-maintain di project-project sebelumnya.

Feel free to fork & adjust sesuai kebutuhan lo!

---

**License:** MIT
