# Task: Create Santri CRUD Resource

## Context
- Model: Santri
- Table: santris
- Relations: 
  - belongsTo(Pesantren)
  - hasMany(Prestasi)

## Requirements
1. **Migration**
   ```php
   Schema::create('santris', function (Blueprint $table) {
       $table->id();
       $table->foreignId('pesantren_id')->constrained()->cascadeOnDelete();
       $table->string('nama');
       $table->string('nis')->unique();
       $table->date('tanggal_lahir');
       $table->enum('jenis_kelamin', ['L', 'P']);
       $table->text('alamat')->nullable();
       $table->string('no_hp')->nullable();
       $table->timestamps();
       
       $table->index(['pesantren_id', 'nis']);
   });
   ```

2. **Model Santri**
   - Fillable: nama, nis, tanggal_lahir, jenis_kelamin, alamat, no_hp
   - Casts: tanggal_lahir → date
   - Relations: pesantren(), prestasis()

3. **Filament Resource**
   - Form: TextInput (nama, nis, no_hp), DatePicker (tanggal_lahir), Select (jenis_kelamin, pesantren_id), Textarea (alamat)
   - Table: Columns (nama, nis, pesantren.nama, jenis_kelamin, tanggal_lahir)
   - Filters: SelectFilter (pesantren, jenis_kelamin), DateRangeFilter (tanggal_lahir)

4. **Tests**
   - Test create santri
   - Test update santri
   - Test delete santri (cascade prestasi)
   - Test validation (nis unique)

## Commands
```bash
php artisan migrate
php artisan test --filter=SantriTest
```
