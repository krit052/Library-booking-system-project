# Database Project (prodatabase)

ระบบยืม-คืน หนังสือ (Book), บอร์ดเกม (Boardgame) และห้อง (Room) เขียนด้วย PHP + MySQL/MariaDB
มีทั้งฝั่งผู้ใช้ทั่วไป (สมัครสมาชิก/ล็อกอิน/ยืม-คืน) และฝั่งแอดมิน (จัดการข้อมูล)

## โครงสร้างโปรเจกต์

```
Database Project code/
├── SQL/                     # ไฟล์ dump ฐานข้อมูล (import เข้า MySQL)
│   ├── users.sql            # ผู้ใช้ทั่วไป
│   ├── ad_user.sql          # ผู้ใช้แอดมิน
│   ├── book.sql             # รายการหนังสือ
│   ├── boardgame.sql        # รายการบอร์ดเกม
│   ├── room.sql             # รายการห้อง
│   ├── brbooks.sql          # ประวัติการยืม-คืนหนังสือ
│   ├── brboardgames.sql     # ประวัติการยืม-คืนบอร์ดเกม
│   └── broom.sql            # ประวัติการยืม-คืนห้อง
└── prodatabase_finish/      # โค้ดเว็บแอป (PHP)
    ├── config.php           # การตั้งค่าเชื่อมต่อฐานข้อมูล
    ├── index.php            # หน้า Login
    ├── register.php         # หน้าสมัครสมาชิก
    ├── home3.php             # หน้า Home หลังล็อกอิน
    ├── edit.php             # แก้ไขข้อมูลผู้ใช้
    ├── logout.php
    ├── brbook.php / brboardgame.php / broom.php   # หน้ายืม-คืน
    ├── MyProjectBook/       # โมดูลจัดการ/แสดงรายการหนังสือ
    ├── MyProjectBoardgame/  # โมดูลจัดการ/แสดงรายการบอร์ดเกม
    ├── MyProjectRoom/       # โมดูลจัดการ/แสดงรายการห้อง
    └── admin/               # ระบบฝั่งแอดมิน (indexadmin.php คือหน้า login แอดมิน)
```

## สิ่งที่ต้องมีก่อนเริ่ม (Requirements)

- [XAMPP](https://www.apachefriends.org/) (Apache + PHP 8.x + MariaDB/MySQL) หรือชุด PHP/MySQL อื่นที่เทียบเท่า
- เว็บเบราว์เซอร์ทั่วไป

โปรเจกต์นี้ไม่มี dependency manager (ไม่มี composer/npm) เป็น PHP ล้วนที่รันผ่าน Apache ได้ทันที

## วิธีติดตั้งและตั้งค่า (Setup)

### 1. คัดลอกโค้ดไปไว้ใน htdocs

คัดลอกโฟลเดอร์ `prodatabase_finish` ไปไว้ที่ `C:\xampp\htdocs\prodatabase_finish`
(Apache จะเสิร์ฟเฉพาะไฟล์ในโฟลเดอร์ `htdocs` เท่านั้น)

### 2. เปิด Apache และ MySQL

เปิด **XAMPP Control Panel** แล้วกด **Start** ที่แถว Apache และ MySQL

> ถ้า Apache ขึ้น error ว่าพอร์ต 80 ถูกใช้งานอยู่แล้ว (เช่นมีโปรแกรมอื่น/IIS จับพอร์ตนี้ไว้) ให้แก้ `C:\xampp\apache\conf\httpd.conf` เปลี่ยน `Listen 80` และ `ServerName localhost:80` เป็นพอร์ตอื่น เช่น `8080` แล้วเข้าเว็บผ่าน `http://localhost:8080/...` แทน

### 3. สร้างฐานข้อมูลและ import ข้อมูล

เปิด phpMyAdmin ที่ `http://localhost/phpmyadmin` (หรือ `http://localhost:8080/phpmyadmin` ถ้าเปลี่ยนพอร์ต) แล้ว:

1. สร้างฐานข้อมูลชื่อ **`prodatabase`** (ชื่อนี้ถูก hardcode ไว้ใน [config.php](prodatabase_finish/config.php))
2. Import ไฟล์ .sql ทั้งหมดในโฟลเดอร์ [SQL/](SQL/) เข้าไปในฐานข้อมูลนี้ (ลำดับไม่สำคัญ แต่แนะนำให้ import `users.sql` และ `ad_user.sql` ก่อน):
   - `users.sql`, `ad_user.sql`, `book.sql`, `boardgame.sql`, `room.sql`, `brbooks.sql`, `brboardgames.sql`, `broom.sql`

หรือ import ผ่าน command line:

```bash
mysql -u root prodatabase < SQL/users.sql
mysql -u root prodatabase < SQL/ad_user.sql
mysql -u root prodatabase < SQL/book.sql
mysql -u root prodatabase < SQL/boardgame.sql
mysql -u root prodatabase < SQL/room.sql
mysql -u root prodatabase < SQL/brbooks.sql
mysql -u root prodatabase < SQL/brboardgames.sql
mysql -u root prodatabase < SQL/broom.sql
```

### 4. ตรวจสอบการตั้งค่าเชื่อมต่อฐานข้อมูล

ไฟล์ [prodatabase_finish/config.php](prodatabase_finish/config.php) ตั้งค่าไว้ตามค่าเริ่มต้นของ XAMPP:

```php
$con = mysqli_connect("localhost", "root", "", "prodatabase") or die("Couldn't connect");
```

ถ้า MySQL ของคุณตั้ง user/password ไว้ต่างจากนี้ (ไม่ใช่ `root` ไม่มีรหัสผ่าน) ให้แก้ไฟล์นี้ให้ตรงกับเครื่องของคุณ

## วิธีรัน (Run)

หลังตั้งค่าเสร็จ เปิดเบราว์เซอร์ไปที่:

- **หน้าผู้ใช้ทั่วไป:** `http://localhost/prodatabase_finish/index.php`
- **หน้าแอดมิน:** `http://localhost/prodatabase_finish/admin/indexadmin.php`

(ถ้าเปลี่ยน Apache ไปพอร์ต 8080 ให้ใช้ `http://localhost:8080/...` แทน)

### บัญชีทดสอบ (มาพร้อมกับข้อมูลใน SQL dump)

| ประเภท | Email | Password | หมายเหตุ |
|---|---|---|---|
| ผู้ใช้ทั่วไป | `041@gmail.com` | `43267` | Username: Boss |
| ผู้ใช้ทั่วไป | `042@gmail.com` | `1234` | Username: Phoom |
| แอดมิน | `041@gmail.com` | `43267` | Username: Boss (ในตาราง `ad_user`) |

หรือสมัครสมาชิกใหม่ได้ที่หน้า **Sign Up** (`register.php`)

## ฟีเจอร์หลัก

- สมัครสมาชิก / ล็อกอิน / ล็อกเอาต์ (session-based)
- ดูรายการหนังสือ, บอร์ดเกม, ห้อง และทำการยืม-คืน
- ดูประวัติการยืม-คืนของตัวเองในหน้า Home
- ระบบแอดมินสำหรับจัดการข้อมูล (ดูโฟลเดอร์ [admin/](prodatabase_finish/admin/))

## ข้อควรทราบ

- โปรเจกต์นี้เป็นงานเรียน/เดโม ยังไม่ได้ใช้ prepared statements ทุกจุด (มีบางจุดต่อ query ด้วย string ตรง ๆ) และเก็บรหัสผ่านแบบ plain text ในฐานข้อมูล **ไม่ควรนำไปใช้งานจริงบน production โดยไม่ปรับปรุงด้านความปลอดภัยก่อน**
- ไม่มีไฟล์ `.env` หรือ config แยกสภาพแวดล้อม ค่าเชื่อมต่อฐานข้อมูลทั้งหมดอยู่ใน `config.php` โดยตรง
