## YiiCash - Касса взаимопощи. Премии и штрафы

Система учета штрафов и премений сотрудников.

### Install

```bash
git clone https://github.com/imoisey/yiicash.git
cd yiicash
docker-compose up -d
docker-compose exec php /bin/bash
composer install
./yii migrate/up
```

### Todo

- [ ] Фильтр по дате в "Списке событий"
- [ ] Форма для формирования отчета
- [ ] Формирования отчета по сотрудникам за период
- [ ] Добавлениe RBAC