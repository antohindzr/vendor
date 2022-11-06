    Для запуска проекта необходимо:
- создать MySQL-БД vendorDB;
- выполнить миграцию таблиц: php artisan migrate;
- выполнить в БД скрипт toVendor.sql (в корне проекта);
- запустить проект: php artisan serve.

    Приложение включает в себя RESTAPI-версию и WEB-версию.
    
    Примеры запросов, доступных к выполнению через Postman:
- GET: http://localhost:8000/api/requestVendor;
- GET: http://localhost:8000/api/requestEquipment;
- POST: http://localhost:8000/api/saveEquipment?vendorID=1&serial=XXAAAAAXAI;
- POST: http://localhost:8000/api/saveVendor?vendorType=TP-Link TL-WR745&maskSN=XXBBBBBBBB;

    Примеры запросов, доступных к выполнению через Web-интерфейс:
- http://127.0.0.1:8000/vendor;
- http://127.0.0.1:8000/equipment;
- http://127.0.0.1:8000/equipment/create;
- http://127.0.0.1:8000/equipment/1/edit.
