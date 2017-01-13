#untuk form renter
SELECT
	renter.fullname,
	renter.gender,
	renter.father,
	renter.mother,
	renter.phone,
	renter.address,
	owner.id_owner,
	room.room_name
FROM
	tbl_renter AS renter LEFT JOIN tbl_owner as owner ON renter.id_owner = owner.id_owner
	LEFT JOIN tbl_rooms AS room ON renter.id_room = room.id_room
WHERE owner.id_owner='1';

SELECT
	pay.id_payment,
	renter.fullname,
	room.room_name,
	pay.date_trans,
	pay.total_month,
	pay.payment,
	pay.total
FROM
	tbl_payment AS pay
	LEFT JOIN tbl_renter AS renter ON pay.id_renter = renter.id_renter
	LEFT JOIN tbl_rooms AS room ON pay.id_room = room.id_room
	LEFT JOIN tbl_owner AS owner ON room.id_owner = owner.id_owner
WHERE owner.id_owner='1';

#untuk combobox milik owner-renter-add.php
SELECT
	room.id_room,
	room.room_name
FROM
	tbl_owner AS own
	LEFT JOIN tbl_rooms AS room ON own.id_owner = room.id_owner
WHERE
	own.id_owner='1';
	
#untuk combobox milik owner-payment-add.php
SELECT
	rent.id_renter,
	rent.fullname
FROM
	tbl_owner AS own
	LEFT JOIN tbl_renter AS rent ON own.id_owner = rent.id_owner
WHERE
	own.id_owner='1';
	
SELECT
	room.room_name
FROM
	tbl_renter AS rent
	LEFT JOIN tbl_rooms AS room ON rent.id_room = room.id_room
WHERE
	rent.id_renter='2';
	
#untuk combobox milik owner-house.php
SELECT
	own.id_owner,
	clas.id_class,
	clas.class_name
FROM
	tbl_owner AS own
	LEFT  JOIN tbl_class AS clas ON own.id_owner = clas.id_owner
WHERE own.id_owner='1';

#contoh

SELECT
    jakul.id_jadwal,
    makul.nama_matkul,
    jakul.kelas,
    dosen.nama_dosen,
    jakul.jam,
    jakul.hari,
    ruang.nama_ruang,
    mhs.nim
FROM
    tbl_jakul AS jakul
    LEFT JOIN tbl_matkul AS makul ON    jakul.id_matkul = makul.id_matkul
    LEFT JOIN tbl_dosen AS dosen ON jakul.nik   = dosen.nik
    LEFT JOIN tbl_ruang AS ruang ON jakul.id_ruang  = ruang.id_ruang
    LEFT JOIN tbl_mahasiswa AS mhs ON jakul.nim = mhs.nim
WHERE
    mhs.nim='$user_login[nim]'

#dynamic selectbox room
SELECT * FROM tbl_renter WHERE id_room='1';

#dynamic selectbox room on owner-payment-add.php
SELECT
	room.id_room,
	room.room_name
FROM
	tbl_owner AS own
	LEFT JOIN tbl_rooms AS room ON room.id_owner = own.id_owner
	LEFT JOIN tbl_renter AS rent ON rent.id_room = room.id_room
WHERE
	own.id_owner='1';
	
#dynamic selectbox class on owner-payment-add.php
SELECT
	cls.id_class,
	cls.class_name,
	cls.price
FROM
	tbl_owner AS own
	LEFT JOIN tbl_class AS cls ON cls.id_owner = own.id_owner
WHERE
	own.id_owner='1';
	
SELECT
	cla.price
FROM tbl_class AS cla
	LEFT JOIN tbl_rooms AS room ON room.id_class = cla.id_class
WHERE cla.id_class='1';


SELECT
	own.id_owner,
	cla.class_name,
	cla.price
FROM tbl_owner AS own
	LEFT JOIN tbl_class AS cla ON cla.id_owner = own.id_owner
WHERE own.id_owner='1';

SELECT
	own.id_owner,
	room.room_name,
	cla.class_name,
	room.`status`,
	room.photo
FROM tbl_owner AS own
	RIGHT JOIN tbl_class AS cla ON cla.id_owner = own.id_owner
	RIGHT JOIN tbl_rooms AS room ON room.id_class = cla.id_class
WHERE own.id_owner='1';

SELECT id_class, id_owner, class_name, price FROM tbl_class ORDER BY id_class DESC;

#tabel class select
SELECT
	id_owner,
	class_name,
	price
FROM
	tbl_class WHERE id_class='1';
	
#pagination room
SELECT
					own.id_owner,
					room.room_name,
					cla.class_name,
					room.status,
					room.photo
				FROM tbl_owner AS own
					RIGHT JOIN tbl_class AS cla ON cla.id_owner = own.id_owner
					RIGHT JOIN tbl_rooms AS room ON room.id_class = cla.id_class
				WHERE own.id_owner='$ownerRow[id_owner]' LIMIT $start_room, $per_page

SELECT
	own.id_owner,
	room.room_name,
	room.`status`,
	room.photo
FROM
	tbl_owner AS own
	LEFT JOIN tbl_rooms AS room ON room.id_owner = own.id_owner
WHERE
	own.id_owner = '$ownerRow[id_owner]' LIMIT $start_room, $per_page
	
#for editing form
SELECT id_room, id_owner, room_name, id_class, status, photo FROM tbl_rooms ORDER BY id_room DESC;

SELECT cls.price FROM tbl_class AS cls WHERE id_class

#for payment table
SELECT
						pay.id_payment,
						renter.fullname,
						renter.gender,
						renter.mother,
						renter.phone,
						renter.father,
						renter.address,
						room.room_name,
						pay.date_trans,
						pay.total_month,
						pay.payment,
						pay.total
					FROM
						tbl_payment AS pay
						LEFT JOIN tbl_renter AS renter ON pay.id_renter = renter.id_renter
						LEFT JOIN tbl_rooms AS room ON pay.id_room = room.id_room
						LEFT JOIN tbl_owner AS owner ON room.id_owner = owner.id_owner
					WHERE owner.id_owner='1'