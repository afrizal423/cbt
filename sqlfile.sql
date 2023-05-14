--
-- PostgreSQL database dump
--

-- Dumped from database version 14.7 (Ubuntu 14.7-0ubuntu0.22.10.1)
-- Dumped by pg_dump version 14.7 (Ubuntu 14.7-0ubuntu0.22.10.1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: gurus; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.gurus (
    id character(26) NOT NULL,
    user_id character(26),
    nama_guru character varying(100),
    alamat_guru character varying(100),
    jabatan_guru character varying(100),
    notelp_guru character varying(20),
    foto_guru character varying(100)
);


--
-- Name: ikut_ujians; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.ikut_ujians (
    id character(26) NOT NULL,
    siswa_id character(26),
    ujian_id character(26),
    status boolean DEFAULT true,
    sudah_ujian boolean DEFAULT false,
    deleted_at timestamp(0) without time zone
);


--
-- Name: jawaban_ujians; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.jawaban_ujians (
    id character(26) NOT NULL,
    soal_id character(26),
    siswa_id character(26),
    ujian_id character(26),
    jawaban_siswa text,
    bobot_nilai double precision,
    ragu_jawaban boolean,
    selesai_ujian boolean,
    rekomendasi_bobot_nilai double precision,
    data_rekomendasi_nilai json,
    deleted_at timestamp(0) without time zone
);


--
-- Name: jobs; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: kelas; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.kelas (
    id character(26) NOT NULL,
    kode_kelas character varying(50),
    nama_kelas character varying(50)
);


--
-- Name: list_jawabansoals; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.list_jawabansoals (
    id character(26) NOT NULL,
    type_jawaban character varying(20),
    text_jawaban json,
    soal_id character(26),
    "keyPilgan" character(26)
);


--
-- Name: mapels; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.mapels (
    id character(26) NOT NULL,
    kode_mapel character varying(200),
    nama_mapel character varying(200),
    kkm_mapel double precision,
    jumlah_opsi_jawaban integer DEFAULT 5,
    jumlah_pilihan_ganda integer,
    jumlah_essai integer,
    status_mapel boolean
);


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: nilais; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.nilais (
    id character(26) NOT NULL,
    ujian_id character(26),
    siswa_id character(26),
    nilai_ujian double precision,
    status_penilaian boolean,
    deleted_at timestamp(0) without time zone
);


--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


--
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;


--
-- Name: sessions; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id character(26),
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


--
-- Name: siswas; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.siswas (
    id character(26) NOT NULL,
    nisn character varying(100),
    nama_siswa character varying(100),
    tgl_lahir_siswa date,
    alamat_siswa character varying(200),
    password character varying(100),
    kelas_id character(26)
);


--
-- Name: soalnya_siswa_ujians; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.soalnya_siswa_ujians (
    id character(26) NOT NULL,
    siswa_id character(26),
    ujian_id character(26),
    listsoal json,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: soals; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.soals (
    id character(26) NOT NULL,
    mapel_id character(26),
    no_soal smallint,
    soal text,
    opsi_jawaban json,
    kunci text,
    media_soal character varying(1),
    type_soal character varying(100),
    bobot_soal double precision
);


--
-- Name: ujians; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.ujians (
    id character(26) NOT NULL,
    mapel_id character(26),
    guru_id character(26),
    kelas_id character(26),
    judul character varying(100),
    jenis_ujian character varying(50),
    tgl_mulai_ujian date,
    waktu_mulai_ujian time(0) without time zone,
    tgl_selesai_ujian date,
    waktu_selesai_ujian time(0) without time zone,
    keterlambatan_ujian integer DEFAULT 1,
    code_ujian character varying(20),
    status_ujian boolean DEFAULT false,
    status_penilaian_ujian boolean DEFAULT false,
    status_jobs_selesai_ujian boolean DEFAULT false,
    deleted_at timestamp(0) without time zone
);


--
-- Name: users; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.users (
    id character(26) NOT NULL,
    email character varying(255),
    username character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    level character varying(10) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: gurus; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.gurus (id, user_id, nama_guru, alamat_guru, jabatan_guru, notelp_guru, foto_guru) FROM stdin;
01gneykbbtzaxtms60c82nkmej	01gneykbaxf4accarc496pdwkf	Ini admin	Dk. Baik No. 988, Magelang 98673, Babel	ini admin	0541 9620 2750	\N
01gneykbeppdbnt0vx0tg0976z	01gneykbejt2wnhwm5h9kgex3h	Ini Guru	Jr. Samanhudi No. 202, Administrasi Jakarta Barat 45621, Sumsel	guru tetap	0699 9254 2513	\N
\.


--
-- Data for Name: ikut_ujians; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.ikut_ujians (id, siswa_id, ujian_id, status, sudah_ujian, deleted_at) FROM stdin;
01gneykfemxakhsxqta65kmag4	01gneykbg4rb51b4v1wdk6dp66	01gneykfakhvdeyygknfwqkyvw	t	t	\N
\.


--
-- Data for Name: jawaban_ujians; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.jawaban_ujians (id, soal_id, siswa_id, ujian_id, jawaban_siswa, bobot_nilai, ragu_jawaban, selesai_ujian, rekomendasi_bobot_nilai, data_rekomendasi_nilai, deleted_at) FROM stdin;
01gneykfg6mamvdkbhg0em2dc1	01g7335jr5y1bs76ge2te5efb3	01gneykbg4rb51b4v1wdk6dp66	01gneykfakhvdeyygknfwqkyvw	"01g7334vpy69cawhsytshg9ec4"	10	f	\N	10	\N	\N
01gneykfg7mve9xah7m697zzh6	01g7362t3yn9qqn8mxy5xj24s8	01gneykbg4rb51b4v1wdk6dp66	01gneykfakhvdeyygknfwqkyvw	"gambaran keseluruhan dari paragraf"	10	t	\N	10	[{"text":"gambaran keseluruhan dari sebuah paragraf","similarity":1},{"text":"Ide pokok bacaan berfungsi untuk menjelaskan inti atau pokok pembahasan utama dari suatu paragraf","similarity":0.06054936462149973},{"text":"Ide pokok bacaan adalah ide yang menjadi pokok atau pikiran utama dalam mengembangkan paragraf suatu bacaan","similarity":0.05709245287522211}]	\N
01gneykfg8nsvd4nac8yqw294a	01g735fxanwmxsydzh8yqbd6f3	01gneykbg4rb51b4v1wdk6dp66	01gneykfakhvdeyygknfwqkyvw	"01g735cwq6v85ttd741et0pk3n"	10	f	\N	10	\N	\N
01gneykfg9nrap6rp5s7zcxj1n	01g735pvg27nnd491j2bj1ctev	01gneykbg4rb51b4v1wdk6dp66	01gneykfakhvdeyygknfwqkyvw	"kalimat yang berisi ide pokok"	5	t	\N	5	[{"text":"Kalimat ini diartikan sebagai kalimat yang mengandung pokok pikiran paragraf","similarity":0.1786972569536653},{"text":"kalimat yang berisi ide pokok atau ide utama paragraf","similarity":0.5400123534870788},{"text":"kalimat jabaran yang isinya penjebaran dari pokok pikiran tersebut","similarity":0.3488810801322895},{"text":"Kalimat utama adalah kalimat yang berada di awal paragraf","similarity":0.08521932550520887}]	\N
01gneykfgantsjwsyqdkekfzx5	01g732vctje9f7j72xj5m1hj7k	01gneykbg4rb51b4v1wdk6dp66	01gneykfakhvdeyygknfwqkyvw	"01g732sftj1w4bq9jd00xjc2xm"	10	f	\N	10	\N	\N
01gneykfgbys8gfkx53zbafsgf	01g7330hg18mh4mt8x5zt9xqvp	01gneykbg4rb51b4v1wdk6dp66	01gneykfakhvdeyygknfwqkyvw	"01g732xhxshtk694ncpyffveh8"	10	f	\N	10	\N	\N
01gneykfgc1etvp4gn12jxr9r1	01g7333r7d726ryh3twg5q38jm	01gneykbg4rb51b4v1wdk6dp66	01gneykfakhvdeyygknfwqkyvw	"01g7332yngcqkggn7w50wrs2dt"	10	f	\N	10	\N	\N
01gneykfgdbc55tp0snhqq745a	01g735rzyztses2fm78rgxm6ec	01gneykbg4rb51b4v1wdk6dp66	01gneykfakhvdeyygknfwqkyvw	"membaca dengan seksama"	10	t	\N	10	[{"text":"Membaca judul teks","similarity":0.19905123822737344},{"text":"Membaca teks dengan cermat.","similarity":0.19905123822737344},{"text":"Menentukan ide pokok setiap paragra","similarity":0},{"text":"Menandai kata kunci","similarity":0},{"text":"membaca dengan seksama","similarity":1}]	\N
01gneykfgec431kb9ks77hg11h	01g735txk7r0w6d14d30tqp1zb	01gneykbg4rb51b4v1wdk6dp66	01gneykfakhvdeyygknfwqkyvw	"Kalimat utama bisa berada di awal sebuah paragraf"	8	t	\N	8	[{"text":"Kalimat utama bisa berada di awal atau akhir sebuah paragraf.","similarity":0.7795729685029128},{"text":"Menemukan kalimat utama yang berisi gagasan pokok.","similarity":0.16475708389497723},{"text":"Membedakan kalimat utama dan penjelas.","similarity":0.21923440971541877},{"text":"Mengetahui jenis paragraf.","similarity":0.11946078283645291},{"text":"Membaca secara intensif isi paragraf, menentukan kalimat utama pada paragraf, menentukan unsur inti kalimat utama","similarity":0.1416064474587855}]	\N
01gneykfgfcbp61rcr8z39mr64	01g735zf1wn3n3a25y8vq8vmg3	01gneykbg4rb51b4v1wdk6dp66	01gneykfakhvdeyygknfwqkyvw	"gambaran keseluruhan dari paragraf"	10	t	\N	10	[{"text":"gambaran keseluruhan dari suatu paragraf","similarity":1},{"text":"ide\\/gagasan yang menjadi pokok pengembangan paragraf. Gagasan utama terdapat di kalimat utama dan setiap paragraf hanya memiliki satu ide pokok. Berdasarkan letaknya, kalimat utama bisa terdapat pada awal paragraf (paragraf deduktif), akhir paragraf (paragraf induktif), dan awal sekaligus akhir paragraf (Campuran).","similarity":0.021960622481149737},{"text":"Gagasan Utama atau ide pokok merupakan pernyataan yang menjadi inti pembahasan. Gagasan utama terdapat pada kalimat utama dalam setiap paragraf. Letaknya biasanya terdapat pada awal atau akhir paragraf","similarity":0.03620216168368331}]	\N
\.


--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- Data for Name: kelas; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.kelas (id, kode_kelas, nama_kelas) FROM stdin;
01g4w9xx1ej4cfj6hawkvkbkg9	6A	6 A
01g4w9y4qqjrdkanc355f33gqy	6B	6 B
01g6qas85p236m57nr72ewcsdg	6C	6 C
\.


--
-- Data for Name: list_jawabansoals; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.list_jawabansoals (id, type_jawaban, text_jawaban, soal_id, "keyPilgan") FROM stdin;
01g735fxawn2jx7g1r6xywtpsw	pilgan	"<p>Catat poin informasi<\\/p>\\n"	01g735fxanwmxsydzh8yqbd6f3	01g735cwq6v85ttd741et0pk3n
01g735fxb0dr7mrnq2v02sgvjh	pilgan	"<p>lewati topik<\\/p>\\n"	01g735fxanwmxsydzh8yqbd6f3	01g735cwq75ad330b3mrtmfzsp
01g735fxb2rftg4f4qmf82kp29	pilgan	"<p>Abaikan pesan informasi<\\/p>\\n"	01g735fxanwmxsydzh8yqbd6f3	01g735cwq8r55q8f6v5s62se2b
01g735fxb5rbapmkpvycnahex9	pilgan	"<p>Ubah informasinya<\\/p>\\n"	01g735fxanwmxsydzh8yqbd6f3	01g735cwq9hbt809jfgdbhtpxv
01g732vctscejp54f1zzf284qc	pilgan	"<p>Komputer dapat digunakan untuk bermain<\\/p>\\n"	01g732vctje9f7j72xj5m1hj7k	01g732sftfbekg30nzp1krqm4d
01g732vctwf7xz9e4yv4gc47qk	pilgan	"<p>Komputer sangat bermanfaat bagi manusia<\\/p>\\n"	01g732vctje9f7j72xj5m1hj7k	01g732sftgyc5mpc13xksk5kc5
01g732vctzxw05vazj43p83cew	pilgan	"<p>Komputer membantu orang mengetik<\\/p>\\n"	01g732vctje9f7j72xj5m1hj7k	01g732sfthzbn38v48jczpnhkg
01g732vcv1chx9dhdtyacwbca2	pilgan	"<p>Semua pekerjaan bisa dilakukan dengan cepat<\\/p>\\n"	01g732vctje9f7j72xj5m1hj7k	01g732sftj1w4bq9jd00xjc2xm
01g7330hg8qs2zeqq8s3t8crxf	pilgan	"<p>(1) &ndash; (2) &ndash; (3) &ndash; (4)<\\/p>\\n"	01g7330hg18mh4mt8x5zt9xqvp	01g732xhxrspsg72s5np7dm7ds
01g7330hga34q97zszfvbg4hb4	pilgan	"<p>(3) &ndash; (4) &ndash; (1) &ndash; (2)<\\/p>\\n"	01g7330hg18mh4mt8x5zt9xqvp	01g732xhxshtk694ncpyffveh8
01g7330hgdc5jv0xs3d1cbm66c	pilgan	"<p>(2) &ndash; (3) &ndash; (1) &ndash; (4)<\\/p>\\n"	01g7330hg18mh4mt8x5zt9xqvp	01g732xhxta72mhe8anh5y6bzf
01g7330hgg10vf3v1zberjcakh	pilgan	"<p>(4) &ndash; (3) &ndash; (2) &ndash; (1)<\\/p>\\n"	01g7330hg18mh4mt8x5zt9xqvp	01g732xhxv97m6nhht7h2mck44
01g7333r7hmes9mbws9pc3qb2v	pilgan	"<p>konsultasi<\\/p>\\n"	01g7333r7d726ryh3twg5q38jm	01g7332yngcqkggn7w50wrs2dt
01g7333r7k8hxkq0y3wv6nx7v2	pilgan	"<p>sebuah pertanyaan<\\/p>\\n"	01g7333r7d726ryh3twg5q38jm	01g7332ynhxm9sw7x43zw3n4cx
01g7333r7pc5egershtk0zxt3b	pilgan	"<p>usul<\\/p>\\n"	01g7333r7d726ryh3twg5q38jm	01g7332ynjscpy1vbkf4fx40km
01g7333r7sjm6mt8vp6bsaab98	pilgan	"<p>kritik<\\/p>\\n"	01g7333r7d726ryh3twg5q38jm	01g7332ynkfp41bs5at4c068xk
01g7335jrcns093e564byn75kh	pilgan	"<p>Melakukan sesuatu harus disertai dengan antusiasme<\\/p>\\n"	01g7335jr5y1bs76ge2te5efb3	01g7334vpvg8nktwbfqt1h33y3
01g7335jrfzd55778ggt9z70kg	pilgan	"<p>Didampingi oleh ketabahan, kesuksesan bisa diraih<\\/p>\\n"	01g7335jr5y1bs76ge2te5efb3	01g7334vpwp7jz190z05vzspxd
01g7335jrj0j3h532crasvn30r	pilgan	"<p>Mencoba sesuatu harus berjalan seiring dengan doa<\\/p>\\n"	01g7335jr5y1bs76ge2te5efb3	01g7334vpxsye251nhca3hppgp
01g7335jrrhqc719rr2gggkz45	pilgan	"<p>Dengan upaya, kesuksesan bisa diraih<\\/p>\\n"	01g7335jr5y1bs76ge2te5efb3	01g7334vpy69cawhsytshg9ec4
01g7362t43wy6706kehbz1f6xh	essai	["gambaran keseluruhan dari sebuah paragraf","Ide pokok bacaan berfungsi untuk menjelaskan inti atau pokok pembahasan utama dari suatu paragraf"]	01g7362t3yn9qqn8mxy5xj24s8	\N
01g735zf206hz4rk2kpsafg41g	essai	["gambaran keseluruhan dari suatu paragraf","ide\\/gagasan yang menjadi pokok pengembangan paragraf. Gagasan utama terdapat di kalimat utama dan setiap paragraf hanya memiliki satu ide pokok. Berdasarkan letaknya, kalimat utama bisa terdapat pada awal paragraf (paragraf deduktif), akhir paragraf (paragraf induktif), dan awal sekaligus akhir paragraf (Campuran)."]	01g735zf1wn3n3a25y8vq8vmg3	\N
01g735txkd5dtcn02t8xjs6psf	essai	["Kalimat utama bisa berada di awal atau akhir sebuah paragraf.","Menemukan kalimat utama yang berisi gagasan pokok.","Membedakan kalimat utama dan penjelas.","Mengetahui jenis paragraf."]	01g735txk7r0w6d14d30tqp1zb	\N
01g735rzz6axt8sbx89g8571rz	essai	["Membaca judul teks","Membaca teks dengan cermat.","Menentukan ide pokok setiap paragra","Menandai kata kunci"]	01g735rzyztses2fm78rgxm6ec	\N
01g735pvg98wsmt3zn01wszc0h	essai	["Kalimat ini diartikan sebagai kalimat yang mengandung pokok pikiran paragraf","kalimat yang berisi ide pokok atau ide utama paragraf","kalimat jabaran yang isinya penjebaran dari pokok pikiran tersebut"]	01g735pvg27nnd491j2bj1ctev	\N
01gkv0fkqzkry65qwcpxt160tz	essai	[]	01gkv0fkqkemm27ttbarj7kdad	\N
01gkv0kcwy7facgf8vjqn2zcsa	essai	["Kedua"]	01gkv0kcwsxwdvawbrpvtp203p	\N
01gkv0p1tt5hkrjzyqtpmrky2w	essai	["mengharumkan nama Indonesia di kancah internasional","menjaga keamanan wilayah negara dari ancaman luar","menggunakan bahasa Indonesia yang baik dan benar","melestarikan budaya Indonesia"]	01gkv0p1tmm2v1zm8n9e4v6kef	\N
01gkv0t5e009v8c44j7rwmt5kp	essai	[]	01gkv0t5dw3s7fseb8v1fvym78	\N
01gkv0v7vjx3janjdjaxvjrc22	essai	[]	01gkv0v7vbkadvn12yrvwjrgr7	\N
01gkv0zhrwmwzcxvz78sb9xyqj	essai	[]	01gkv0zhrnt76z8hefyjah1kzb	\N
01gkv117ayn6am09nsrvk2txj5	essai	[]	01gkv117arja8ssehtafg8bsss	\N
01gkv15mq8h2164yrpzwterfkq	essai	["Hak di lingkungan keluarga"]	01gkv15mq37chj6qa4bdjyc64m	\N
01gkv1xvzq3granhharjcm0nz1	essai	["Keadilan Sosial bagi Seluruh Rakyat Indonesia\\nMenghargai hasil karya teman bermain\\nSaling menghargai sesama teman di tempat bermain"]	01gkv1xvzgws4d10sms6k3rjsp	\N
01gkv21gm9kmm47fnqtycg50ev	essai	[]	01gkv21gm2f57vh7sec94e2tns	\N
01gkv230qqsd827rk42m16063a	essai	["Pasal 29 ayat 2 : hak kebebasan memeluk agama\\nPasal 31 ayat 1 : hak mendapatkan pendidikan\\nPasal 28E ayat (3) : kebebasan berserikat berkumpul dan mengeluarkan pendapat"]	01gkv230qj20cbfr1qgkf8n5mx	\N
01gkv0rt35nphm8mmhg8e6f9a5	essai	["sumber hukum di Indonesia","dasar negara"]	01gkv0rt2wye680q0wy8qg4ywt	\N
01gkv12zcye67rpb42txh9dray	essai	["Kewajiban masyarakat","Kewajiban"]	01gkv12zcq9f1nt3vvsjmnrpry	\N
01gkv1zpfxq85sbp196pyy051f	essai	[]	01gkv1zpfn800nba2fk7wd8m2f	\N
01gkv246j0210y63hk34v99rq1	essai	["27 ayat 1 : setiap warga negara wajib menjunjung hukum \\nPasal 30 ayat 1 : setiap warga negara wajib ikut dalam usaha pertahanan dan keamanan negara"]	01gkv246htbc9jpmxnh10hz9yn	\N
\.


--
-- Data for Name: mapels; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.mapels (id, kode_mapel, nama_mapel, kkm_mapel, jumlah_opsi_jawaban, jumlah_pilihan_ganda, jumlah_essai, status_mapel) FROM stdin;
01g732g64qmcd0vs0x3x1aedrz	BHSINDOKLS6A	Bahasa Indonesia Kelas 6	60	4	5	5	\N
01gkv0cavf1hhcyd8s0hg1552d	PPKN6	UH PPKN Kelas 6	70	0	0	15	t
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.migrations (id, migration, batch) FROM stdin;
121	2014_10_12_000000_create_users_table	1
122	2014_10_12_100000_create_password_resets_table	1
123	2019_08_19_000000_create_failed_jobs_table	1
124	2019_12_14_000001_create_personal_access_tokens_table	1
125	2022_07_03_215439_create_gurus_table	1
126	2022_07_03_215439_create_ikut_ujians_table	1
127	2022_07_03_215439_create_jawaban_ujians_table	1
128	2022_07_03_215439_create_kelas_table	1
129	2022_07_03_215439_create_list_jawabansoals_table	1
130	2022_07_03_215439_create_mapels_table	1
131	2022_07_03_215439_create_nilais_table	1
132	2022_07_03_215439_create_siswas_table	1
133	2022_07_03_215439_create_soals_table	1
134	2022_07_03_215439_create_ujians_table	1
135	2022_07_03_215440_add_foreign_keys_to_gurus_table	1
136	2022_07_03_215440_add_foreign_keys_to_ikut_ujians_table	1
137	2022_07_03_215440_add_foreign_keys_to_jawaban_ujians_table	1
138	2022_07_03_215440_add_foreign_keys_to_list_jawabansoals_table	1
139	2022_07_03_215440_add_foreign_keys_to_nilais_table	1
140	2022_07_03_215440_add_foreign_keys_to_soals_table	1
141	2022_07_03_215440_add_foreign_keys_to_ujians_table	1
142	2022_07_13_175624_create_sessions_table	1
143	2022_09_27_182306_create_soalnya_siswa_ujians_table	1
144	2022_10_12_071831_create_jobs_table	1
\.


--
-- Data for Name: nilais; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.nilais (id, ujian_id, siswa_id, nilai_ujian, status_penilaian, deleted_at) FROM stdin;
01gneykfepyr33bs4tzq33cbwf	01gneykfakhvdeyygknfwqkyvw	01gneykbg4rb51b4v1wdk6dp66	0	f	\N
\.


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.password_resets (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
\.


--
-- Data for Name: siswas; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.siswas (id, nisn, nama_siswa, tgl_lahir_siswa, alamat_siswa, password, kelas_id) FROM stdin;
01gneykbg4rb51b4v1wdk6dp66	123	rizal	2017-06-19	Ki. Sadang Serang No. 77, Tasikmalaya 34446, Sulbar	123	01g6qas85p236m57nr72ewcsdg
01gneykbg78wt2xnfzy2ac66bz	ZVNGENCWBW	Ana Oliva Wastuti S.I.Kom	2016-09-20	Psr. Dahlia No. 983, Tangerang Selatan 62644, Sulut	123	01g4w9y4qqjrdkanc355f33gqy
01gneykbga6qcwz6yjvjgt9kdk	9OJSIJHAW7	Upik Yahya Hutagalung M.TI.	2016-12-15	Ds. Baja Raya No. 561, Sabang 63926, Bali	123	01g4w9xx1ej4cfj6hawkvkbkg9
01gneykbgc9fcja95hg08q2kq9	XVASFZMDE9	Rika Rahmi Rahimah	2017-08-31	Jr. HOS. Cjokroaminoto (Pasirkaliki) No. 694, Solok 13728, Papua	123	01g4w9y4qqjrdkanc355f33gqy
01gneykbgfh5vck94z3qntvgv4	OV709EQEN0	Dimaz Garda Saefullah S.Pd	2016-11-05	Ds. Qrisdoren No. 445, Bitung 42392, Bali	123	01g4w9y4qqjrdkanc355f33gqy
01gneykbgj1db01mk7erbg2fq4	TG2HAZJTQV	Lanang Saptono	2017-02-18	Gg. Gading No. 581, Tebing Tinggi 23727, Kalsel	123	01g4w9y4qqjrdkanc355f33gqy
01gneykbgpf1n5ezmrky5rjwhq	TWYN8638BL	Oni Fujiati	2016-09-15	Ds. Lumban Tobing No. 398, Administrasi Jakarta Timur 96751, Jatim	123	01g4w9xx1ej4cfj6hawkvkbkg9
01gneykbgs4vt6y9s4c9hs2xgv	JSE65V3H6B	Indah Bella Hartati M.Ak	2017-08-11	Kpg. Dago No. 960, Tanjung Pinang 46728, Sumut	123	01g4w9y4qqjrdkanc355f33gqy
01gneykbgwkggd6w06f5efxnbb	46ZO1MSMJV	Betania Andriani	2017-10-22	Jln. Imam No. 793, Tanjungbalai 28441, Sumbar	123	01g4w9y4qqjrdkanc355f33gqy
01gneykbgz72y0fepgxj95zn64	D6K0QPGZBM	Waluyo Dongoran	2017-12-16	Ds. Thamrin No. 292, Sibolga 63238, Jambi	123	01g4w9y4qqjrdkanc355f33gqy
01gneykbh2sqkagpsd6gv4cw2g	YSJJJGO61I	Hardi Narpati	2016-03-28	Dk. Bakhita No. 263, Payakumbuh 71396, NTT	123	01g4w9xx1ej4cfj6hawkvkbkg9
\.


--
-- Data for Name: soalnya_siswa_ujians; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.soalnya_siswa_ujians (id, siswa_id, ujian_id, listsoal, created_at, updated_at) FROM stdin;
01gneykfcfwge3r1j1qv59g6b5	01gneykbg78wt2xnfzy2ac66bz	01gneykfahwccktdwn99vqhhpm	["01g735zf1wn3n3a25y8vq8vmg3","01g7335jr5y1bs76ge2te5efb3","01g7330hg18mh4mt8x5zt9xqvp","01g7362t3yn9qqn8mxy5xj24s8","01g735rzyztses2fm78rgxm6ec","01g7333r7d726ryh3twg5q38jm","01g735txk7r0w6d14d30tqp1zb","01g735fxanwmxsydzh8yqbd6f3","01g732vctje9f7j72xj5m1hj7k","01g735pvg27nnd491j2bj1ctev"]	2022-12-29 19:44:37	2022-12-29 19:44:37
01gneykfctj1ccfznc9sc43wm4	01gneykbgc9fcja95hg08q2kq9	01gneykfahwccktdwn99vqhhpm	["01g735pvg27nnd491j2bj1ctev","01g735txk7r0w6d14d30tqp1zb","01g7362t3yn9qqn8mxy5xj24s8","01g732vctje9f7j72xj5m1hj7k","01g735zf1wn3n3a25y8vq8vmg3","01g7330hg18mh4mt8x5zt9xqvp","01g735fxanwmxsydzh8yqbd6f3","01g7333r7d726ryh3twg5q38jm","01g7335jr5y1bs76ge2te5efb3","01g735rzyztses2fm78rgxm6ec"]	2022-12-29 19:44:37	2022-12-29 19:44:37
01gneykfd5b07k9wj4rxptsf8y	01gneykbgfh5vck94z3qntvgv4	01gneykfahwccktdwn99vqhhpm	["01g7330hg18mh4mt8x5zt9xqvp","01g732vctje9f7j72xj5m1hj7k","01g735zf1wn3n3a25y8vq8vmg3","01g735fxanwmxsydzh8yqbd6f3","01g7333r7d726ryh3twg5q38jm","01g735rzyztses2fm78rgxm6ec","01g7335jr5y1bs76ge2te5efb3","01g735pvg27nnd491j2bj1ctev","01g735txk7r0w6d14d30tqp1zb","01g7362t3yn9qqn8mxy5xj24s8"]	2022-12-29 19:44:37	2022-12-29 19:44:37
01gneykfdgyft94p6a39c171cp	01gneykbgj1db01mk7erbg2fq4	01gneykfahwccktdwn99vqhhpm	["01g7362t3yn9qqn8mxy5xj24s8","01g735zf1wn3n3a25y8vq8vmg3","01g7335jr5y1bs76ge2te5efb3","01g735rzyztses2fm78rgxm6ec","01g735fxanwmxsydzh8yqbd6f3","01g735pvg27nnd491j2bj1ctev","01g7330hg18mh4mt8x5zt9xqvp","01g7333r7d726ryh3twg5q38jm","01g732vctje9f7j72xj5m1hj7k","01g735txk7r0w6d14d30tqp1zb"]	2022-12-29 19:44:37	2022-12-29 19:44:37
01gneykfdv3wey0z3wf0xcs53d	01gneykbgs4vt6y9s4c9hs2xgv	01gneykfahwccktdwn99vqhhpm	["01g735pvg27nnd491j2bj1ctev","01g7362t3yn9qqn8mxy5xj24s8","01g735zf1wn3n3a25y8vq8vmg3","01g735rzyztses2fm78rgxm6ec","01g735fxanwmxsydzh8yqbd6f3","01g7333r7d726ryh3twg5q38jm","01g732vctje9f7j72xj5m1hj7k","01g7335jr5y1bs76ge2te5efb3","01g7330hg18mh4mt8x5zt9xqvp","01g735txk7r0w6d14d30tqp1zb"]	2022-12-29 19:44:37	2022-12-29 19:44:37
01gneykfe6zfq53zcvrskc59yb	01gneykbgwkggd6w06f5efxnbb	01gneykfahwccktdwn99vqhhpm	["01g7362t3yn9qqn8mxy5xj24s8","01g732vctje9f7j72xj5m1hj7k","01g7335jr5y1bs76ge2te5efb3","01g735txk7r0w6d14d30tqp1zb","01g735pvg27nnd491j2bj1ctev","01g735zf1wn3n3a25y8vq8vmg3","01g735fxanwmxsydzh8yqbd6f3","01g7333r7d726ryh3twg5q38jm","01g735rzyztses2fm78rgxm6ec","01g7330hg18mh4mt8x5zt9xqvp"]	2022-12-29 19:44:37	2022-12-29 19:44:37
01gneykfehr0tqgd722ff0v3xe	01gneykbgz72y0fepgxj95zn64	01gneykfahwccktdwn99vqhhpm	["01g7330hg18mh4mt8x5zt9xqvp","01g735rzyztses2fm78rgxm6ec","01g735zf1wn3n3a25y8vq8vmg3","01g732vctje9f7j72xj5m1hj7k","01g7362t3yn9qqn8mxy5xj24s8","01g735pvg27nnd491j2bj1ctev","01g7333r7d726ryh3twg5q38jm","01g735txk7r0w6d14d30tqp1zb","01g735fxanwmxsydzh8yqbd6f3","01g7335jr5y1bs76ge2te5efb3"]	2022-12-29 19:44:37	2022-12-29 19:44:37
01gneykfbbc6p70e016v354wgz	01gneykbga6qcwz6yjvjgt9kdk	01gneykfac2w9rpgmazhbc0exq	["01g7330hg18mh4mt8x5zt9xqvp","01g7362t3yn9qqn8mxy5xj24s8","01g735rzyztses2fm78rgxm6ec","01g735fxanwmxsydzh8yqbd6f3","01g7335jr5y1bs76ge2te5efb3","01g735zf1wn3n3a25y8vq8vmg3","01g7333r7d726ryh3twg5q38jm","01g735txk7r0w6d14d30tqp1zb","01g732vctje9f7j72xj5m1hj7k","01g735pvg27nnd491j2bj1ctev"]	2022-12-29 19:44:37	2022-12-29 19:59:10
01gneykfbr39cbhmybmmsdnxk4	01gneykbgpf1n5ezmrky5rjwhq	01gneykfac2w9rpgmazhbc0exq	["01g7330hg18mh4mt8x5zt9xqvp","01g732vctje9f7j72xj5m1hj7k","01g7362t3yn9qqn8mxy5xj24s8","01g735rzyztses2fm78rgxm6ec","01g735fxanwmxsydzh8yqbd6f3","01g735pvg27nnd491j2bj1ctev","01g735zf1wn3n3a25y8vq8vmg3","01g7333r7d726ryh3twg5q38jm","01g735txk7r0w6d14d30tqp1zb","01g7335jr5y1bs76ge2te5efb3"]	2022-12-29 19:44:37	2022-12-29 19:59:10
01gneykfc3xyeqytpc8yc1fv3h	01gneykbh2sqkagpsd6gv4cw2g	01gneykfac2w9rpgmazhbc0exq	["01g7330hg18mh4mt8x5zt9xqvp","01g735zf1wn3n3a25y8vq8vmg3","01g7362t3yn9qqn8mxy5xj24s8","01g735rzyztses2fm78rgxm6ec","01g735fxanwmxsydzh8yqbd6f3","01g7335jr5y1bs76ge2te5efb3","01g735pvg27nnd491j2bj1ctev","01g732vctje9f7j72xj5m1hj7k","01g735txk7r0w6d14d30tqp1zb","01g7333r7d726ryh3twg5q38jm"]	2022-12-29 19:44:37	2022-12-29 19:59:10
01gneykfewet8ddd6d0h3nv1d0	01gneykbg4rb51b4v1wdk6dp66	01gneykfakhvdeyygknfwqkyvw	["01g7362t3yn9qqn8mxy5xj24s8","01g7330hg18mh4mt8x5zt9xqvp","01g732vctje9f7j72xj5m1hj7k","01g7335jr5y1bs76ge2te5efb3","01g735zf1wn3n3a25y8vq8vmg3","01g735pvg27nnd491j2bj1ctev","01g735fxanwmxsydzh8yqbd6f3","01g7333r7d726ryh3twg5q38jm","01g735rzyztses2fm78rgxm6ec","01g735txk7r0w6d14d30tqp1zb"]	2022-12-29 19:44:37	2023-05-14 12:32:00
\.


--
-- Data for Name: soals; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.soals (id, mapel_id, no_soal, soal, opsi_jawaban, kunci, media_soal, type_soal, bobot_soal) FROM stdin;
01g7362t3yn9qqn8mxy5xj24s8	01g732g64qmcd0vs0x3x1aedrz	\N	<p>Jelaskan yang dimaksud ide pokok bacaan</p>\n	\N	Ide pokok bacaan adalah ide yang menjadi pokok atau pikiran utama dalam mengembangkan paragraf suatu bacaan	\N	essai	10
01g735zf1wn3n3a25y8vq8vmg3	01g732g64qmcd0vs0x3x1aedrz	\N	<p>Apa yang dimaksud dengan gagasan utama dalam paragraf?</p>\n	\N	Gagasan Utama atau ide pokok merupakan pernyataan yang menjadi inti pembahasan. Gagasan utama terdapat pada kalimat utama dalam setiap paragraf. Letaknya biasanya terdapat pada awal atau akhir paragraf	\N	essai	10
01g735txk7r0w6d14d30tqp1zb	01g732g64qmcd0vs0x3x1aedrz	\N	<p>Bagaimana cara menemukan gagasan utama pada paragraf?</p>\n	\N	Membaca secara intensif isi paragraf, menentukan kalimat utama pada paragraf, menentukan unsur inti kalimat utama	\N	essai	10
01g735rzyztses2fm78rgxm6ec	01g732g64qmcd0vs0x3x1aedrz	\N	<p>Bagaimana cara mencari informasi dari sebuah teks?</p>\n	\N	membaca dengan seksama	\N	essai	10
01g735pvg27nnd491j2bj1ctev	01g732g64qmcd0vs0x3x1aedrz	\N	<p>Apa yang dimaksud dengan kalimat utama dalam paragraf?</p>\n	\N	Kalimat utama adalah kalimat yang berada di awal paragraf	\N	essai	10
01g735fxanwmxsydzh8yqbd6f3	01g732g64qmcd0vs0x3x1aedrz	\N	<p>Sebelum kita menanggapi konten berita / informasi, kita harus dapat.</p>\n	\N	01g735cwq6v85ttd741et0pk3n	\N	pilgan	10
01g7335jr5y1bs76ge2te5efb3	01g732g64qmcd0vs0x3x1aedrz	\N	<p>Semut merah mencoba naik di atas daun melawan ombak besar. Berkat kegigihannya, dia berhasil mencapai dan memegang permukaan daun.</p>\n	\N	01g7334vpy69cawhsytshg9ec4	\N	pilgan	10
01g7333r7d726ryh3twg5q38jm	01g732g64qmcd0vs0x3x1aedrz	\N	<p>Orang tidak seharusnya membuang sampah ke sungai agar tidak banjir.</p>\n\n<p>Kalimat itu adalah kalimat.</p>\n	\N	01g7332yngcqkggn7w50wrs2dt	\N	pilgan	10
01g7330hg18mh4mt8x5zt9xqvp	01g732g64qmcd0vs0x3x1aedrz	\N	<p>Dian: &ldquo;Kamu benar-benar layak menjadi juara<br />\nanggi: &ldquo;Ini berkat doa-doamu<br />\nDian : &ldquo;Selamat, Yang Mulia<br />\nAnggi: &ldquo;Terima kasih, Dian&rdquo;</p>\n\n<p>&nbsp;</p>\n\n<p>Kesepakatan yang baik untuk percakapan adalah.</p>\n	\N	01g732xhxshtk694ncpyffveh8	\N	pilgan	10
01g732vctje9f7j72xj5m1hj7k	01g732g64qmcd0vs0x3x1aedrz	\N	<p>Komputer mengambil banyak tekanan di tempat kerja. Komputer dapat membantu orang memasukkan, menyimpan, atau menganalisis data. Ini tidak hanya membantu pekerjaan, tetapi juga dengan hiburan di komunitas. Saat bosan, orang dapat mendengarkan musik dan memainkan game dari komputer.</p>\n\n<p>Ringkasan isi paragraf di atas adalah.</p>\n	\N	01g732sftj1w4bq9jd00xjc2xm	\N	pilgan	10
01gkv0fkqkemm27ttbarj7kdad	01gkv0cavf1hhcyd8s0hg1552d	\N	<p>Kata Pancasila di ambil dari kitab Sutasoma yang merupakan karangan dari</p>\n	\N	Empu Tantular	\N	essai	5
01gkv0kcwsxwdvawbrpvtp203p	01gkv0cavf1hhcyd8s0hg1552d	\N	<p>Saling menasehati apabila ada teman yang menyontek atau tidak melaksanakan tugas piket merupakan salah satu contoh penerapan sila Pancasila, yaitu sila</p>\n	\N	Sila kedua	\N	essai	5
01gkv0p1tmm2v1zm8n9e4v6kef	01gkv0cavf1hhcyd8s0hg1552d	\N	<p>Cinta tanah air dan bangsa dapat diwujudkan dengan</p>\n	\N	Membeli produk dalam negeri	\N	essai	5
01gkv0t5dw3s7fseb8v1fvym78	01gkv0cavf1hhcyd8s0hg1552d	\N	<p>Sikap berani dan tidak mudah menyerah serta rela berkorban demi bangsa dan negara disebut dengan&nbsp;</p>\n	\N	Patriotisme	\N	essai	5
01gkv0v7vbkadvn12yrvwjrgr7	01gkv0cavf1hhcyd8s0hg1552d	\N	<p>Segala sesuatu yang mutlak menjadi milik seseorang dan penggunaanya tergantung pada orang yang bersangkutan disebut&nbsp;</p>\n	\N	Hak	\N	essai	5
01gkv0zhrnt76z8hefyjah1kzb	01gkv0cavf1hhcyd8s0hg1552d	\N	<p>Segala sesuatu yang harus dilakukan atau dilaksanakan oleh setiap individu dengan penuh rasa tanggung jawab disebut&nbsp;</p>\n	\N	Kewajiban	\N	essai	5
01gkv117arja8ssehtafg8bsss	01gkv0cavf1hhcyd8s0hg1552d	\N	<p>Suatu perbuatan sebagai wujud kesadaran atas kewajiban yang dimilikinya disebut</p>\n	\N	Tanggung Jawab	\N	essai	5
01gkv12zcq9f1nt3vvsjmnrpry	01gkv0cavf1hhcyd8s0hg1552d	\N	<p>Dalam kehidupan bermasyarakat, tentu terdapat aturan dan norma yang harus dilakukan dan dipatuhi. Mematuhi aturan dan norma merupakan</p>\n	\N	Kewajiban masyarakat Indonesia	\N	essai	5
01gkv15mq37chj6qa4bdjyc64m	01gkv0cavf1hhcyd8s0hg1552d	\N	<p>Mendapatkan perlindungan dan rasa aman dalam keluarga merupakan&nbsp;</p>\n	\N	Hak di lingkungan rumah atau keluarga	\N	essai	5
01gkv1xvzgws4d10sms6k3rjsp	01gkv0cavf1hhcyd8s0hg1552d	\N	<p>Sebutkan bunyi dan nilai yang terkandung dalam sila ke-5 Pancasila serta 3 contoh penerapan nilai Pancasila sila ke-5 dalam kehidupan sehari-hari!</p>\n	\N	Keadilan Sosial bagi Seluruh Rakyat Indonesia\nBersikap adil terhadap semua teman di tempat bermain.\nMemberikan bantuan jika ada teman bermain yang kesusahan\nMenghindari sikap sombong di tempat bermain	\N	essai	10
01gkv21gm2f57vh7sec94e2tns	01gkv0cavf1hhcyd8s0hg1552d	\N	<p>Sebutkan 5 nilai juang dalam proses perumusan Pancasila</p>\n	\N	Nilai persatuan dan kesatuan\nnilai keikhlasan\nBerani menegakkan kebenaran dan keadilan\nToleran terhadap perbedaan\nNilai musyawarah mufakat	\N	essai	10
01gkv246htbc9jpmxnh10hz9yn	01gkv0cavf1hhcyd8s0hg1552d	\N	<p>Sebagai warga negara, kita memiliki kewajiban yang harus dilaksanakan. Sebutkan 3 contoh kewajiban warga negara yang terdapat dalam UUD 1945 beserta pasalnya!</p>\n	\N	Pasal 23A ayat  : membayar pajak\nPasal 27 ayat (3) : ikut serta dalam upaya pembelaan negara\nPasal 31 ayat (2) : mengikuti pendidikan dasar 	\N	essai	10
01gkv230qj20cbfr1qgkf8n5mx	01gkv0cavf1hhcyd8s0hg1552d	\N	<p>Hak dan kewajiban harus dilaksanakan secara seimbang. Sebutkan 3 contoh hak warga negara yang terdapat dalam UUD 1945 beserta pasalnya!</p>\n	\N	Pasal 27 ayat 1 : mendapat perlindungan hukum\nPasal 27 ayat 3 : ikut serta dalam upaya bela negara\nPasal 28E ayat 3 : kebebasan berserikat berkumpul dan mengeluarkan pendapat	\N	essai	10
01gkv0rt2wye680q0wy8qg4ywt	01gkv0cavf1hhcyd8s0hg1552d	\N	<p>Salah satu fungsi Pancasila bagi bangsa Indonesia adalah</p>\n	\N	pedoman hidup bangsa	\N	essai	5
01gkv1zpfn800nba2fk7wd8m2f	01gkv0cavf1hhcyd8s0hg1552d	\N	<p>Sebutkan usulan rumusan Pancasila yang di usulkan oleh Muhammad yamin secara lisan dalam sidang BPUPKI tanggal 29 Mei 1945</p>\n	\N	Peri Kebangsaan\nPeri Kemanusiaan\nPeri Ketuhanan\nPeri Kerakyatan\nKesejahteraan Sosial atau Rakyat	\N	essai	10
\.


--
-- Data for Name: ujians; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.ujians (id, mapel_id, guru_id, kelas_id, judul, jenis_ujian, tgl_mulai_ujian, waktu_mulai_ujian, tgl_selesai_ujian, waktu_selesai_ujian, keterlambatan_ujian, code_ujian, status_ujian, status_penilaian_ujian, status_jobs_selesai_ujian, deleted_at) FROM stdin;
01gneykfahwccktdwn99vqhhpm	01g732g64qmcd0vs0x3x1aedrz	01gneykbeppdbnt0vx0tg0976z	01g4w9y4qqjrdkanc355f33gqy	UH Bahasa Indonesia Kelas 6 B	UH	2022-10-21	04:00:00	2022-12-26	23:59:00	1	123	f	f	f	2022-12-29 19:54:24
01gneykfac2w9rpgmazhbc0exq	01g732g64qmcd0vs0x3x1aedrz	01gneykbeppdbnt0vx0tg0976z	01g4w9xx1ej4cfj6hawkvkbkg9	UH Bahasa Indonesia Kelas 6 A	UH	2022-10-21	04:00:00	2022-12-26	23:59:00	1	123	f	f	f	2022-12-29 20:00:42
01gneykfakhvdeyygknfwqkyvw	01g732g64qmcd0vs0x3x1aedrz	01gneykbeppdbnt0vx0tg0976z	01g6qas85p236m57nr72ewcsdg	UH Bahasa Indonesia Kelas 6 C	UH	2022-10-21	04:00:00	2022-12-26	23:59:00	1	123	f	f	f	\N
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.users (id, email, username, email_verified_at, password, level, remember_token, created_at, updated_at) FROM stdin;
01gneykbaxf4accarc496pdwkf	me@afrizalmy.com	admin	\N	$2y$10$/rrxNBkOixd94BDTbxUakeRXvEG5xLu1xUcS0c.qG7OqDuknoMJ9y	admin	\N	2022-12-29 19:44:33	2022-12-29 19:44:33
01gneykbejt2wnhwm5h9kgex3h	guru@afrizalmy.com	guru	\N	$2y$10$O9GSsYlD97WlV3cs23TbHuJD/JYvKt.2W6emP.uKv9Xv99V3H9Re6	guru	\N	2022-12-29 19:44:33	2022-12-29 19:44:33
\.


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.jobs_id_seq', 28, true);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.migrations_id_seq', 144, true);


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: gurus gurus_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.gurus
    ADD CONSTRAINT gurus_pkey PRIMARY KEY (id);


--
-- Name: ikut_ujians ikut_ujians_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ikut_ujians
    ADD CONSTRAINT ikut_ujians_pkey PRIMARY KEY (id);


--
-- Name: jawaban_ujians jawaban_ujian_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.jawaban_ujians
    ADD CONSTRAINT jawaban_ujian_pk UNIQUE (id);


--
-- Name: jawaban_ujians jawaban_ujians_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.jawaban_ujians
    ADD CONSTRAINT jawaban_ujians_pkey PRIMARY KEY (id);


--
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: kelas kelas_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.kelas
    ADD CONSTRAINT kelas_pk UNIQUE (id);


--
-- Name: kelas kelas_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.kelas
    ADD CONSTRAINT kelas_pkey PRIMARY KEY (id);


--
-- Name: list_jawabansoals list_jawabansoals_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.list_jawabansoals
    ADD CONSTRAINT list_jawabansoals_pkey PRIMARY KEY (id);


--
-- Name: mapels mapel_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.mapels
    ADD CONSTRAINT mapel_pk UNIQUE (id);


--
-- Name: mapels mapels_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.mapels
    ADD CONSTRAINT mapels_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: nilais nilais_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.nilais
    ADD CONSTRAINT nilais_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: siswas siswas_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.siswas
    ADD CONSTRAINT siswas_pkey PRIMARY KEY (id);


--
-- Name: soalnya_siswa_ujians soalnya_siswa_ujians_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.soalnya_siswa_ujians
    ADD CONSTRAINT soalnya_siswa_ujians_pkey PRIMARY KEY (id);


--
-- Name: soals soals_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.soals
    ADD CONSTRAINT soals_pkey PRIMARY KEY (id);


--
-- Name: ujians ujians_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ujians
    ADD CONSTRAINT ujians_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: users users_username_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_unique UNIQUE (username);


--
-- Name: akun_fk; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX akun_fk ON public.gurus USING btree (user_id);


--
-- Name: hasil_siswa_fk; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX hasil_siswa_fk ON public.nilais USING btree (siswa_id);


--
-- Name: jawaban_dari_ujian_fk; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX jawaban_dari_ujian_fk ON public.jawaban_ujians USING btree (ujian_id);


--
-- Name: jawaban_siswa_fk; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX jawaban_siswa_fk ON public.jawaban_ujians USING btree (siswa_id);


--
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- Name: membuat_fk; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX membuat_fk ON public.ujians USING btree (guru_id);


--
-- Name: memiliki_fk; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX memiliki_fk ON public.ujians USING btree (kelas_id);


--
-- Name: memiliki_jawaban_fk; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX memiliki_jawaban_fk ON public.jawaban_ujians USING btree (soal_id);


--
-- Name: memiliki_mapel_fk; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX memiliki_mapel_fk ON public.ujians USING btree (mapel_id);


--
-- Name: memiliki_soal_fk; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX memiliki_soal_fk ON public.soals USING btree (mapel_id);


--
-- Name: nilai_ujian_siswa_fk; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX nilai_ujian_siswa_fk ON public.nilais USING btree (ujian_id);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);


--
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: siswa_ikut_ujian_fk; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX siswa_ikut_ujian_fk ON public.ikut_ujians USING btree (siswa_id);


--
-- Name: status_ujian_siswa_fk; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX status_ujian_siswa_fk ON public.ikut_ujians USING btree (ujian_id);


--
-- Name: gurus fk_gurus_akun_users; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.gurus
    ADD CONSTRAINT fk_gurus_akun_users FOREIGN KEY (user_id) REFERENCES public.users(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: ikut_ujians fk_ikut_uji_siswa_iku_siswas; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ikut_ujians
    ADD CONSTRAINT fk_ikut_uji_siswa_iku_siswas FOREIGN KEY (siswa_id) REFERENCES public.siswas(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: ikut_ujians fk_ikut_uji_status_uj_ujians; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ikut_ujians
    ADD CONSTRAINT fk_ikut_uji_status_uj_ujians FOREIGN KEY (ujian_id) REFERENCES public.ujians(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: jawaban_ujians fk_jawaban__jawaban_d_ujians; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.jawaban_ujians
    ADD CONSTRAINT fk_jawaban__jawaban_d_ujians FOREIGN KEY (ujian_id) REFERENCES public.ujians(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: jawaban_ujians fk_jawaban__jawaban_s_siswas; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.jawaban_ujians
    ADD CONSTRAINT fk_jawaban__jawaban_s_siswas FOREIGN KEY (siswa_id) REFERENCES public.siswas(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: jawaban_ujians fk_jawaban__memiliki__soals; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.jawaban_ujians
    ADD CONSTRAINT fk_jawaban__memiliki__soals FOREIGN KEY (soal_id) REFERENCES public.soals(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: list_jawabansoals fk_list_jaw_reference_soals; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.list_jawabansoals
    ADD CONSTRAINT fk_list_jaw_reference_soals FOREIGN KEY (soal_id) REFERENCES public.soals(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: nilais fk_nilais_hasil_sis_siswas; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.nilais
    ADD CONSTRAINT fk_nilais_hasil_sis_siswas FOREIGN KEY (siswa_id) REFERENCES public.siswas(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: nilais fk_nilais_nilai_uji_ujians; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.nilais
    ADD CONSTRAINT fk_nilais_nilai_uji_ujians FOREIGN KEY (ujian_id) REFERENCES public.ujians(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: soals fk_soals_memiliki__mapels; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.soals
    ADD CONSTRAINT fk_soals_memiliki__mapels FOREIGN KEY (mapel_id) REFERENCES public.mapels(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: ujians fk_ujians_membuat_gurus; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ujians
    ADD CONSTRAINT fk_ujians_membuat_gurus FOREIGN KEY (guru_id) REFERENCES public.gurus(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: ujians fk_ujians_memiliki__mapels; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ujians
    ADD CONSTRAINT fk_ujians_memiliki__mapels FOREIGN KEY (mapel_id) REFERENCES public.mapels(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: ujians fk_ujians_memiliki_kelas; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ujians
    ADD CONSTRAINT fk_ujians_memiliki_kelas FOREIGN KEY (kelas_id) REFERENCES public.kelas(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: soalnya_siswa_ujians soalnya_siswa_ujians_siswa_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.soalnya_siswa_ujians
    ADD CONSTRAINT soalnya_siswa_ujians_siswa_id_foreign FOREIGN KEY (siswa_id) REFERENCES public.siswas(id) ON DELETE CASCADE;


--
-- Name: soalnya_siswa_ujians soalnya_siswa_ujians_ujian_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.soalnya_siswa_ujians
    ADD CONSTRAINT soalnya_siswa_ujians_ujian_id_foreign FOREIGN KEY (ujian_id) REFERENCES public.ujians(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

