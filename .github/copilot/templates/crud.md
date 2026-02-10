# Task: Create CRUD Resource

## Context
- Model: [MODEL_NAME]
- Table: [TABLE_NAME]
- Relations: [RELATIONS]

## Requirements
1. **Migration**
   - Create migration file with proper schema
   - Add indexes for foreign keys
   - Add timestamps

2. **Model**
   - Define fillable fields
   - Add relationships (hasMany, belongsTo, etc.)
   - Add casts for dates/booleans

3. **Filament Resource**
   - Create Resource with form & table
   - Add filters (search, date range)
   - Add actions (view, edit, delete)
   - Add bulk actions if needed

4. **Tests**
   - Feature test for CRUD operations
   - Test validation rules
   - Test relationships

## Acceptance Criteria
- [ ] Migration runs without errors
- [ ] Model relationships work correctly
- [ ] Filament Resource displays data properly
- [ ] All tests pass (PHPUnit)

## Files to Create/Modify
- `database/migrations/YYYY_MM_DD_create_[table]_table.php`
- `app/Models/[Model].php`
- `app/Filament/Resources/[Model]Resource.php`
- `tests/Feature/[Model]Test.php`

## Commands to Run
```bash
php artisan migrate
php artisan test --filter=[Model]Test
```

## Notes
- Follow Laravel best practices
- Use Filament v3 syntax
- Add proper docblocks
