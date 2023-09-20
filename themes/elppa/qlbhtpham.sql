/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     9/19/2023 9:46:09 AM                         */
/*==============================================================*/


drop table if exists CHITIETHOADON;

drop table if exists DANHGIASP;

drop table if exists GIAOHANG;

drop table if exists HOADON;

drop table if exists KHUVUC;

drop table if exists KHUYENMAI;

drop table if exists LOAISP;

drop table if exists NGUOIDUNG;

drop table if exists PHUONGTHUCTT;

drop table if exists SANPHAM;

/*==============================================================*/
/* Table: CHITIETHOADON                                         */
/*==============================================================*/
create table CHITIETHOADON
(
   MASP                 char(10) not null,
   MAHD                 char(10) not null,
   SOLUONGSP            char(10) not null,
   primary key (MASP, MAHD)
);

/*==============================================================*/
/* Table: DANHGIASP                                             */
/*==============================================================*/
create table DANHGIASP
(
   MASP                 char(10) not null,
   EMAIL                char(30) not null,
   SAODG                int,
   NDDG                 char(256),
   HINHANHDG            char(256),
   primary key (MASP, EMAIL)
);

/*==============================================================*/
/* Table: GIAOHANG                                              */
/*==============================================================*/
create table GIAOHANG
(
   MAKV                 char(10) not null,
   MAHD                 char(10) not null,
   PHIGIAOHANG          int,
   GHICHUDONHANG        varchar(70),
   primary key (MAKV, MAHD)
);

/*==============================================================*/
/* Table: HOADON                                                */
/*==============================================================*/
create table HOADON
(
   MAHD                 char(10) not null,
   EMAIL                char(30) not null,
   MAPT                 char(10) not null,
   MAKM                 char(10) not null,
   NGAYLAP              datetime not null,
   TONGTIEN             int,
   primary key (MAHD)
);

/*==============================================================*/
/* Table: KHUVUC                                                */
/*==============================================================*/
create table KHUVUC
(
   MAKV                 char(10) not null,
   TENKV                char(256) not null,
   primary key (MAKV)
);

/*==============================================================*/
/* Table: KHUYENMAI                                             */
/*==============================================================*/
create table KHUYENMAI
(
   MAKM                 char(10) not null,
   PHANTRAMKM           int not null,
   NGAYBD               date not null,
   NGAYKT               date not null,
   DIEUKIENKM           int not null,
   primary key (MAKM)
);

/*==============================================================*/
/* Table: LOAISP                                                */
/*==============================================================*/
create table LOAISP
(
   MALOAI               char(10) not null,
   TENLOAI              char(100) not null,
   primary key (MALOAI)
);

/*==============================================================*/
/* Table: NGUOIDUNG                                             */
/*==============================================================*/
create table NGUOIDUNG
(
   EMAIL                char(30) not null,
   MATKHAU              char(30) not null,
   TEN                  char(100) not null,
   SDT                  char(10) not null,
   DIACHI               char(256) not null,
   PHANQUYEN            char(20) not null,
   primary key (EMAIL)
);

/*==============================================================*/
/* Table: PHUONGTHUCTT                                          */
/*==============================================================*/
create table PHUONGTHUCTT
(
   MAPT                 char(10) not null,
   TENPT                char(30) not null,
   primary key (MAPT)
);

/*==============================================================*/
/* Table: SANPHAM                                               */
/*==============================================================*/
create table SANPHAM
(
   MASP                 char(10) not null,
   MALOAI               char(10) not null,
   TENSP                char(100) not null,
   LINKANH              char(256) not null,
   GIA                  int,
   primary key (MASP)
);

alter table CHITIETHOADON add constraint FK_CO_CHI_TIET foreign key (MAHD)
      references HOADON (MAHD) on delete restrict on update restrict;

alter table CHITIETHOADON add constraint FK_RELATIONSHIP_10 foreign key (MASP)
      references SANPHAM (MASP) on delete restrict on update restrict;

alter table DANHGIASP add constraint FK_CO_THE_DANH_GIA foreign key (EMAIL)
      references NGUOIDUNG (EMAIL) on delete restrict on update restrict;

alter table DANHGIASP add constraint FK_DANH_GIA_CUA_SP foreign key (MASP)
      references SANPHAM (MASP) on delete restrict on update restrict;

alter table GIAOHANG add constraint FK_HOA_DON_GIAO_HANG foreign key (MAHD)
      references HOADON (MAHD) on delete restrict on update restrict;

alter table GIAOHANG add constraint FK_KHU_VUC_GIAO_HANG foreign key (MAKV)
      references KHUVUC (MAKV) on delete restrict on update restrict;

alter table HOADON add constraint FK_CO_HOA_DON foreign key (EMAIL)
      references NGUOIDUNG (EMAIL) on delete restrict on update restrict;

alter table HOADON add constraint FK_KHUYEN_MAI_HOA_DON foreign key (MAKM)
      references KHUYENMAI (MAKM) on delete restrict on update restrict;

alter table HOADON add constraint FK_PHUONG_THUC_THANH_TOAN_CUA_HD foreign key (MAPT)
      references PHUONGTHUCTT (MAPT) on delete restrict on update restrict;

alter table SANPHAM add constraint FK_THUOC foreign key (MALOAI)
      references LOAISP (MALOAI) on delete restrict on update restrict;

