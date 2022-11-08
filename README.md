    Приложение включает в себя RESTAPI-версию и WEB-версию.
Для запуска проекта необходимо:
- создать MySQL-БД vendorDB;
- выполнить composer install;
- выполнить миграцию таблиц: php artisan migrate;
- выполнить в БД скрипт toVendor.sql (в корне проекта);
- запустить web-приложение: php artisan serve.
    
    Примеры запросов, доступных к выполнению через Web-интерфейс:
- http://127.0.0.1:8000/vendor;
- http://127.0.0.1:8000/equipment;
- http://127.0.0.1:8000/equipment/create;
- http://127.0.0.1:8000/equipment/1/edit;
- http://localhost:8000/api/requestEquipment;
- http://localhost:8000/api/requestVendor;
    Примеры запросов, доступных к выполнению через Postman:
- GET: http://localhost:8000/api/requestVendor;
- GET: http://localhost:8000/api/requestEquipment;
- POST: http://localhost:8000/api/saveEquipment?vendorID=1&serial=XXAAAAAXAI;
- POST: http://localhost:8000/api/saveVendor?vendorType=TP-Link TL-WR745&maskSN=XXBBBBBBBB;


Запустить rest api приложение: php -S 127.0.0.1:8080
	Примеры запросов, доступных к выполнению через Web-интерфейс:
- http://localhost:8080/app/api/api/read.php;
- http://localhost:8080/app/api/api/single_read.php/?id={};
    Примеры запросов, доступных к выполнению через Postman:
- GET: http://127.0.0.1:8080/app/api/api/read.php;
- GET: http://127.0.0.1:8080/app/api/api/single_read.php/?id={};
- POST: http://127.0.0.1:8080/app/api/api/delete.php; (body raw id);
- POST: http://127.0.0.1:8080/app/api/api/create.php; (body raw vendorID, "serial");
- POST: http://127.0.0.1:8080/app/api/api/update.php; (body raw id, vendorID, "serial").