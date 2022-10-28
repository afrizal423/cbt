--
-- PostgreSQL database dump
--

-- Dumped from database version 14.5 (Ubuntu 14.5-1ubuntu1)
-- Dumped by pg_dump version 14.5 (Ubuntu 14.5-1ubuntu1)

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
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: afrizal
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


ALTER TABLE public.failed_jobs OWNER TO afrizal;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: afrizal
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.failed_jobs_id_seq OWNER TO afrizal;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: afrizal
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: gurus; Type: TABLE; Schema: public; Owner: afrizal
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


ALTER TABLE public.gurus OWNER TO afrizal;

--
-- Name: ikut_ujians; Type: TABLE; Schema: public; Owner: afrizal
--

CREATE TABLE public.ikut_ujians (
    id character(26) NOT NULL,
    siswa_id character(26),
    ujian_id character(26),
    status boolean DEFAULT true,
    sudah_ujian boolean DEFAULT false
);


ALTER TABLE public.ikut_ujians OWNER TO afrizal;

--
-- Name: jawaban_ujians; Type: TABLE; Schema: public; Owner: afrizal
--

CREATE TABLE public.jawaban_ujians (
    id character(26) NOT NULL,
    soal_id character(26),
    siswa_id character(26),
    ujian_id character(26),
    jawaban_siswa json,
    bobot_nilai double precision,
    ragu_jawaban boolean,
    selesai_ujian boolean,
    rekomendasi_bobot_nilai double precision,
    data_rekomendasi_nilai json
);


ALTER TABLE public.jawaban_ujians OWNER TO afrizal;

--
-- Name: jobs; Type: TABLE; Schema: public; Owner: afrizal
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


ALTER TABLE public.jobs OWNER TO afrizal;

--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: afrizal
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.jobs_id_seq OWNER TO afrizal;

--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: afrizal
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: kelas; Type: TABLE; Schema: public; Owner: afrizal
--

CREATE TABLE public.kelas (
    id character(26) NOT NULL,
    kode_kelas character varying(50),
    nama_kelas character varying(50)
);


ALTER TABLE public.kelas OWNER TO afrizal;

--
-- Name: list_jawabansoals; Type: TABLE; Schema: public; Owner: afrizal
--

CREATE TABLE public.list_jawabansoals (
    id character(26) NOT NULL,
    type_jawaban character varying(20),
    text_jawaban json,
    soal_id character(26),
    "keyPilgan" character(26)
);


ALTER TABLE public.list_jawabansoals OWNER TO afrizal;

--
-- Name: mapels; Type: TABLE; Schema: public; Owner: afrizal
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


ALTER TABLE public.mapels OWNER TO afrizal;

--
-- Name: migrations; Type: TABLE; Schema: public; Owner: afrizal
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO afrizal;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: afrizal
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO afrizal;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: afrizal
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: nilais; Type: TABLE; Schema: public; Owner: afrizal
--

CREATE TABLE public.nilais (
    id character(26) NOT NULL,
    ujian_id character(26),
    siswa_id character(26),
    id_nilai_ujian character(26),
    nilai_ujian double precision,
    status_penilaian boolean
);


ALTER TABLE public.nilais OWNER TO afrizal;

--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: afrizal
--

CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_resets OWNER TO afrizal;

--
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: afrizal
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


ALTER TABLE public.personal_access_tokens OWNER TO afrizal;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: afrizal
--

CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.personal_access_tokens_id_seq OWNER TO afrizal;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: afrizal
--

ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;


--
-- Name: sessions; Type: TABLE; Schema: public; Owner: afrizal
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id character(26),
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO afrizal;

--
-- Name: siswas; Type: TABLE; Schema: public; Owner: afrizal
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


ALTER TABLE public.siswas OWNER TO afrizal;

--
-- Name: soalnya_siswa_ujians; Type: TABLE; Schema: public; Owner: afrizal
--

CREATE TABLE public.soalnya_siswa_ujians (
    id character(26) NOT NULL,
    siswa_id character(26),
    ujian_id character(26),
    listsoal json,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.soalnya_siswa_ujians OWNER TO afrizal;

--
-- Name: soals; Type: TABLE; Schema: public; Owner: afrizal
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


ALTER TABLE public.soals OWNER TO afrizal;

--
-- Name: ujians; Type: TABLE; Schema: public; Owner: afrizal
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
    status_jobs_selesai_ujian boolean DEFAULT false
);


ALTER TABLE public.ujians OWNER TO afrizal;

--
-- Name: users; Type: TABLE; Schema: public; Owner: afrizal
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


ALTER TABLE public.users OWNER TO afrizal;

--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: afrizal
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
1	2abc3a9b-9b83-4202-a371-7e0849bdfdac	database	default	{"uuid":"2abc3a9b-9b83-4202-a371-7e0849bdfdac","displayName":"App\\\\Jobs\\\\penilaianUjianSiswa","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"maxExceptions":null,"failOnTimeout":false,"backoff":null,"timeout":null,"retryUntil":null,"data":{"commandName":"App\\\\Jobs\\\\penilaianUjianSiswa","command":"O:28:\\"App\\\\Jobs\\\\penilaianUjianSiswa\\":1:{s:8:\\"\\u0000*\\u0000siswa\\";a:2:{s:8:\\"siswa_id\\";s:26:\\"01ge17pg494yx1s29qycjsjvxp\\";s:8:\\"ujian_id\\";s:26:\\"01ge17rk63nfzk87z1sd4fm5xd\\";}}"}}	ErrorException: Undefined array key "kunci" in /home/afrizal/Documents/project/skripsi/project/cbt-backend/app/Jobs/penilaianUjianSiswa.php:54\nStack trace:\n#0 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Foundation/Bootstrap/HandleExceptions.php(259): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError()\n#1 /home/afrizal/Documents/project/skripsi/project/cbt-backend/app/Jobs/penilaianUjianSiswa.php(54): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}()\n#2 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\penilaianUjianSiswa->handle()\n#3 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#4 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#5 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#6 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#7 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#8 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#9 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#10 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#11 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(124): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#12 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#13 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#14 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(126): Illuminate\\Pipeline\\Pipeline->then()\n#15 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#16 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#17 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#18 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#19 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#20 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(150): Illuminate\\Queue\\Worker->daemon()\n#21 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(134): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#22 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#23 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#24 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#25 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#26 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#27 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Console/Command.php(144): Illuminate\\Container\\Container->call()\n#28 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Command/Command.php(308): Illuminate\\Console\\Command->execute()\n#29 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Console/Command.php(126): Symfony\\Component\\Console\\Command\\Command->run()\n#30 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Application.php(1002): Illuminate\\Console\\Command->run()\n#31 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Application.php(299): Symfony\\Component\\Console\\Application->doRunCommand()\n#32 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Application.php(171): Symfony\\Component\\Console\\Application->doRun()\n#33 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#34 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(151): Illuminate\\Console\\Application->run()\n#35 /home/afrizal/Documents/project/skripsi/project/cbt-backend/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#36 {main}	2022-10-12 07:48:12
2	468325bc-87ff-405f-a5dd-3ed09a8e4ada	database	default	{"uuid":"468325bc-87ff-405f-a5dd-3ed09a8e4ada","displayName":"App\\\\Jobs\\\\penilaianUjianSiswa","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"maxExceptions":null,"failOnTimeout":false,"backoff":null,"timeout":null,"retryUntil":null,"data":{"commandName":"App\\\\Jobs\\\\penilaianUjianSiswa","command":"O:28:\\"App\\\\Jobs\\\\penilaianUjianSiswa\\":1:{s:8:\\"\\u0000*\\u0000siswa\\";a:2:{s:8:\\"siswa_id\\";s:26:\\"01ge17pg494yx1s29qycjsjvxp\\";s:8:\\"ujian_id\\";s:26:\\"01ge17rk63nfzk87z1sd4fm5xd\\";}}"}}	ErrorException: Undefined array key "bobot_soal" in /home/afrizal/Documents/project/skripsi/project/cbt-backend/app/Jobs/penilaianUjianSiswa.php:58\nStack trace:\n#0 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Foundation/Bootstrap/HandleExceptions.php(259): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError()\n#1 /home/afrizal/Documents/project/skripsi/project/cbt-backend/app/Jobs/penilaianUjianSiswa.php(58): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}()\n#2 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\penilaianUjianSiswa->handle()\n#3 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#4 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#5 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#6 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#7 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#8 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#9 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#10 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#11 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(124): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#12 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#13 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#14 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(126): Illuminate\\Pipeline\\Pipeline->then()\n#15 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#16 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#17 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#18 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#19 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#20 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(150): Illuminate\\Queue\\Worker->daemon()\n#21 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(134): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#22 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#23 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#24 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#25 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#26 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#27 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Console/Command.php(144): Illuminate\\Container\\Container->call()\n#28 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Command/Command.php(308): Illuminate\\Console\\Command->execute()\n#29 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Console/Command.php(126): Symfony\\Component\\Console\\Command\\Command->run()\n#30 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Application.php(1002): Illuminate\\Console\\Command->run()\n#31 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Application.php(299): Symfony\\Component\\Console\\Application->doRunCommand()\n#32 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Application.php(171): Symfony\\Component\\Console\\Application->doRun()\n#33 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#34 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(151): Illuminate\\Console\\Application->run()\n#35 /home/afrizal/Documents/project/skripsi/project/cbt-backend/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#36 {main}	2022-10-12 16:00:06
3	362b70be-5b02-496b-a504-385f6c580a8e	database	default	{"uuid":"362b70be-5b02-496b-a504-385f6c580a8e","displayName":"App\\\\Jobs\\\\penilaianUjianSiswa","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"maxExceptions":null,"failOnTimeout":false,"backoff":null,"timeout":null,"retryUntil":null,"data":{"commandName":"App\\\\Jobs\\\\penilaianUjianSiswa","command":"O:28:\\"App\\\\Jobs\\\\penilaianUjianSiswa\\":1:{s:8:\\"\\u0000*\\u0000siswa\\";a:2:{s:8:\\"siswa_id\\";s:26:\\"01ge17pg494yx1s29qycjsjvxp\\";s:8:\\"ujian_id\\";s:26:\\"01ge17rk63nfzk87z1sd4fm5xd\\";}}"}}	ErrorException: Undefined array key "bobot_soal" in /home/afrizal/Documents/project/skripsi/project/cbt-backend/app/Jobs/penilaianUjianSiswa.php:58\nStack trace:\n#0 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Foundation/Bootstrap/HandleExceptions.php(259): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError()\n#1 /home/afrizal/Documents/project/skripsi/project/cbt-backend/app/Jobs/penilaianUjianSiswa.php(58): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}()\n#2 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\penilaianUjianSiswa->handle()\n#3 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#4 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#5 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#6 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#7 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#8 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#9 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#10 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#11 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(124): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#12 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#13 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#14 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(126): Illuminate\\Pipeline\\Pipeline->then()\n#15 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#16 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#17 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#18 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#19 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#20 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(150): Illuminate\\Queue\\Worker->daemon()\n#21 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(134): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#22 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#23 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#24 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#25 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#26 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#27 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Console/Command.php(144): Illuminate\\Container\\Container->call()\n#28 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Command/Command.php(308): Illuminate\\Console\\Command->execute()\n#29 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Console/Command.php(126): Symfony\\Component\\Console\\Command\\Command->run()\n#30 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Application.php(1002): Illuminate\\Console\\Command->run()\n#31 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Application.php(299): Symfony\\Component\\Console\\Application->doRunCommand()\n#32 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Application.php(171): Symfony\\Component\\Console\\Application->doRun()\n#33 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#34 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(151): Illuminate\\Console\\Application->run()\n#35 /home/afrizal/Documents/project/skripsi/project/cbt-backend/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#36 {main}	2022-10-12 16:00:30
4	8f317c40-3755-4027-8762-49d43c13534f	database	default	{"uuid":"8f317c40-3755-4027-8762-49d43c13534f","displayName":"App\\\\Jobs\\\\penilaianUjianSiswa","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"maxExceptions":null,"failOnTimeout":false,"backoff":null,"timeout":null,"retryUntil":null,"data":{"commandName":"App\\\\Jobs\\\\penilaianUjianSiswa","command":"O:28:\\"App\\\\Jobs\\\\penilaianUjianSiswa\\":1:{s:8:\\"\\u0000*\\u0000siswa\\";a:2:{s:8:\\"siswa_id\\";s:26:\\"01ge17pg494yx1s29qycjsjvxp\\";s:8:\\"ujian_id\\";s:26:\\"01ge17rk63nfzk87z1sd4fm5xd\\";}}"}}	Error: Cannot use object of type stdClass as array in /home/afrizal/Documents/project/skripsi/project/cbt-backend/app/Jobs/penilaianUjianSiswa.php:37\nStack trace:\n#0 /home/afrizal/Documents/project/skripsi/project/cbt-backend/app/Jobs/penilaianUjianSiswa.php(121): App\\Jobs\\penilaianUjianSiswa->findNilaiMax()\n#1 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\penilaianUjianSiswa->handle()\n#2 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#3 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#4 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#5 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#6 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#7 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#8 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#9 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#10 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(124): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#11 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#12 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#13 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(126): Illuminate\\Pipeline\\Pipeline->then()\n#14 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#15 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#16 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#17 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#18 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#19 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(150): Illuminate\\Queue\\Worker->daemon()\n#20 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(134): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#21 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#22 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#23 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#24 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#25 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#26 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Console/Command.php(144): Illuminate\\Container\\Container->call()\n#27 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Command/Command.php(308): Illuminate\\Console\\Command->execute()\n#28 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Console/Command.php(126): Symfony\\Component\\Console\\Command\\Command->run()\n#29 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Application.php(1002): Illuminate\\Console\\Command->run()\n#30 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Application.php(299): Symfony\\Component\\Console\\Application->doRunCommand()\n#31 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Application.php(171): Symfony\\Component\\Console\\Application->doRun()\n#32 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#33 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(155): Illuminate\\Console\\Application->run()\n#34 /home/afrizal/Documents/project/skripsi/project/cbt-backend/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#35 {main}	2022-10-21 21:31:37
5	cef27f63-2848-450c-bc1f-da51fffe518e	database	default	{"uuid":"cef27f63-2848-450c-bc1f-da51fffe518e","displayName":"App\\\\Jobs\\\\penilaianUjianSiswa","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"maxExceptions":null,"failOnTimeout":false,"backoff":null,"timeout":null,"retryUntil":null,"data":{"commandName":"App\\\\Jobs\\\\penilaianUjianSiswa","command":"O:28:\\"App\\\\Jobs\\\\penilaianUjianSiswa\\":1:{s:8:\\"\\u0000*\\u0000siswa\\";a:2:{s:8:\\"siswa_id\\";s:26:\\"01ge17pg494yx1s29qycjsjvxp\\";s:8:\\"ujian_id\\";s:26:\\"01ge17rk63nfzk87z1sd4fm5xd\\";}}"}}	Error: Cannot use object of type stdClass as array in /home/afrizal/Documents/project/skripsi/project/cbt-backend/app/Jobs/penilaianUjianSiswa.php:37\nStack trace:\n#0 /home/afrizal/Documents/project/skripsi/project/cbt-backend/app/Jobs/penilaianUjianSiswa.php(121): App\\Jobs\\penilaianUjianSiswa->findNilaiMax()\n#1 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\penilaianUjianSiswa->handle()\n#2 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#3 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#4 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#5 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#6 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#7 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#8 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#9 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#10 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(124): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#11 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#12 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#13 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(126): Illuminate\\Pipeline\\Pipeline->then()\n#14 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#15 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#16 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#17 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#18 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#19 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(150): Illuminate\\Queue\\Worker->daemon()\n#20 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(134): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#21 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#22 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#23 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#24 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#25 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#26 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Console/Command.php(144): Illuminate\\Container\\Container->call()\n#27 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Command/Command.php(308): Illuminate\\Console\\Command->execute()\n#28 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Console/Command.php(126): Symfony\\Component\\Console\\Command\\Command->run()\n#29 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Application.php(1002): Illuminate\\Console\\Command->run()\n#30 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Application.php(299): Symfony\\Component\\Console\\Application->doRunCommand()\n#31 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Application.php(171): Symfony\\Component\\Console\\Application->doRun()\n#32 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#33 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(155): Illuminate\\Console\\Application->run()\n#34 /home/afrizal/Documents/project/skripsi/project/cbt-backend/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#35 {main}	2022-10-21 21:32:13
6	85b0adbb-8531-4ea9-a5c2-be060c16de32	database	default	{"uuid":"85b0adbb-8531-4ea9-a5c2-be060c16de32","displayName":"App\\\\Jobs\\\\penilaianUjianSiswa","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"maxExceptions":null,"failOnTimeout":false,"backoff":null,"timeout":null,"retryUntil":null,"data":{"commandName":"App\\\\Jobs\\\\penilaianUjianSiswa","command":"O:28:\\"App\\\\Jobs\\\\penilaianUjianSiswa\\":1:{s:8:\\"\\u0000*\\u0000siswa\\";a:2:{s:8:\\"siswa_id\\";s:26:\\"01ge17pg494yx1s29qycjsjvxp\\";s:8:\\"ujian_id\\";s:26:\\"01ge17rk63nfzk87z1sd4fm5xd\\";}}"}}	Error: Cannot use object of type stdClass as array in /home/afrizal/Documents/project/skripsi/project/cbt-backend/app/Jobs/penilaianUjianSiswa.php:35\nStack trace:\n#0 /home/afrizal/Documents/project/skripsi/project/cbt-backend/app/Jobs/penilaianUjianSiswa.php(125): App\\Jobs\\penilaianUjianSiswa->findNilaiMax()\n#1 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\penilaianUjianSiswa->handle()\n#2 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#3 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#4 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#5 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#6 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#7 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#8 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#9 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#10 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(124): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#11 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#12 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#13 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(126): Illuminate\\Pipeline\\Pipeline->then()\n#14 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#15 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#16 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#17 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#18 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#19 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(150): Illuminate\\Queue\\Worker->daemon()\n#20 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(134): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#21 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#22 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#23 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#24 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#25 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#26 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Console/Command.php(144): Illuminate\\Container\\Container->call()\n#27 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Command/Command.php(308): Illuminate\\Console\\Command->execute()\n#28 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Console/Command.php(126): Symfony\\Component\\Console\\Command\\Command->run()\n#29 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Application.php(1002): Illuminate\\Console\\Command->run()\n#30 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Application.php(299): Symfony\\Component\\Console\\Application->doRunCommand()\n#31 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Application.php(171): Symfony\\Component\\Console\\Application->doRun()\n#32 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#33 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(155): Illuminate\\Console\\Application->run()\n#34 /home/afrizal/Documents/project/skripsi/project/cbt-backend/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#35 {main}	2022-10-23 18:15:41
7	e097d02e-7fab-4e29-b33f-f37366838bac	database	default	{"uuid":"e097d02e-7fab-4e29-b33f-f37366838bac","displayName":"App\\\\Jobs\\\\penilaianUjianSiswa","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"maxExceptions":null,"failOnTimeout":false,"backoff":null,"timeout":null,"retryUntil":null,"data":{"commandName":"App\\\\Jobs\\\\penilaianUjianSiswa","command":"O:28:\\"App\\\\Jobs\\\\penilaianUjianSiswa\\":1:{s:8:\\"\\u0000*\\u0000siswa\\";a:2:{s:8:\\"siswa_id\\";s:26:\\"01ge17pg494yx1s29qycjsjvxp\\";s:8:\\"ujian_id\\";s:26:\\"01ge17rk63nfzk87z1sd4fm5xd\\";}}"}}	Error: Cannot use object of type stdClass as array in /home/afrizal/Documents/project/skripsi/project/cbt-backend/app/Jobs/penilaianUjianSiswa.php:40\nStack trace:\n#0 /home/afrizal/Documents/project/skripsi/project/cbt-backend/app/Jobs/penilaianUjianSiswa.php(135): App\\Jobs\\penilaianUjianSiswa->findNilaiMax()\n#1 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\penilaianUjianSiswa->handle()\n#2 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#3 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#4 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#5 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#6 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#7 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#8 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#9 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#10 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(124): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#11 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#12 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#13 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(126): Illuminate\\Pipeline\\Pipeline->then()\n#14 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#15 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#16 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(425): Illuminate\\Queue\\Jobs\\Job->fire()\n#17 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(375): Illuminate\\Queue\\Worker->process()\n#18 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(173): Illuminate\\Queue\\Worker->runJob()\n#19 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(150): Illuminate\\Queue\\Worker->daemon()\n#20 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(134): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#21 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#22 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#23 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#24 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#25 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#26 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Console/Command.php(144): Illuminate\\Container\\Container->call()\n#27 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Command/Command.php(308): Illuminate\\Console\\Command->execute()\n#28 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Console/Command.php(126): Symfony\\Component\\Console\\Command\\Command->run()\n#29 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Application.php(1002): Illuminate\\Console\\Command->run()\n#30 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Application.php(299): Symfony\\Component\\Console\\Application->doRunCommand()\n#31 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/symfony/console/Application.php(171): Symfony\\Component\\Console\\Application->doRun()\n#32 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run()\n#33 /home/afrizal/Documents/project/skripsi/project/cbt-backend/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(155): Illuminate\\Console\\Application->run()\n#34 /home/afrizal/Documents/project/skripsi/project/cbt-backend/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#35 {main}	2022-10-23 18:25:40
\.


--
-- Data for Name: gurus; Type: TABLE DATA; Schema: public; Owner: afrizal
--

COPY public.gurus (id, user_id, nama_guru, alamat_guru, jabatan_guru, notelp_guru, foto_guru) FROM stdin;
01ge17pfyztmh5hpzypd983nv1	01ge17pfxz664ak7ckt1xb3chp	Ini admin	Jr. Jakarta No. 763, Tanjungbalai 91268, Riau	ini admin	0312 9731 2224	soon
01ge17pg2y7hz5q82gxn8s1jaj	01ge17pg2tw7zktqpbq6xgegjp	Ini Guru	Gg. Ters. Jakarta No. 143, Tual 21687, Sultra	guru tetap	(+62) 26 2986 1158	soon
\.


--
-- Data for Name: ikut_ujians; Type: TABLE DATA; Schema: public; Owner: afrizal
--

COPY public.ikut_ujians (id, siswa_id, ujian_id, status, sudah_ujian) FROM stdin;
01ge17tvy7xq2dv1jr5ercxr34	01ge17pg494yx1s29qycjsjvxp	01ge17rk63nfzk87z1sd4fm5xd	t	t
\.


--
-- Data for Name: jawaban_ujians; Type: TABLE DATA; Schema: public; Owner: afrizal
--

COPY public.jawaban_ujians (id, soal_id, siswa_id, ujian_id, jawaban_siswa, bobot_nilai, ragu_jawaban, selesai_ujian, rekomendasi_bobot_nilai, data_rekomendasi_nilai) FROM stdin;
01gem3h0ftpd6e7xepaw8s5q0x	01g7335jr5y1bs76ge2te5efb3	01ge17pg494yx1s29qycjsjvxp	01ge17rk63nfzk87z1sd4fm5xd	"01g7334vpy69cawhsytshg9ec4"	10	f	\N	10	\N
01gem3gd63a1tmbjy389tvyq14	01g7362t3yn9qqn8mxy5xj24s8	01ge17pg494yx1s29qycjsjvxp	01ge17rk63nfzk87z1sd4fm5xd	"gambaran keseluruhan dari paragraf"	10	t	\N	10	[{"text":"gambaran keseluruhan dari sebuah paragraf","similarity":1},{"text":"Ide pokok bacaan berfungsi untuk menjelaskan inti atau pokok pembahasan utama dari suatu paragraf","similarity":0.06054936462149973},{"text":"Ide pokok bacaan adalah ide yang menjadi pokok atau pikiran utama dalam mengembangkan paragraf suatu bacaan","similarity":0.05709245287522211}]
01gem3gvtm1yh8kcckfcjq184q	01g7333r7d726ryh3twg5q38jm	01ge17pg494yx1s29qycjsjvxp	01ge17rk63nfzk87z1sd4fm5xd	"01g7332yngcqkggn7w50wrs2dt"	10	f	\N	10	\N
01gem3gxcrarcpb20s5y91xgdq	01g735pvg27nnd491j2bj1ctev	01ge17pg494yx1s29qycjsjvxp	01ge17rk63nfzk87z1sd4fm5xd	"kalimat yang berisi ide pokok"	5	t	\N	5	[{"text":"Kalimat ini diartikan sebagai kalimat yang mengandung pokok pikiran paragraf","similarity":0.1786972569536653},{"text":"kalimat yang berisi ide pokok atau ide utama paragraf","similarity":0.5400123534870788},{"text":"kalimat jabaran yang isinya penjebaran dari pokok pikiran tersebut","similarity":0.3488810801322895},{"text":"Kalimat utama adalah kalimat yang berada di awal paragraf","similarity":0.08521932550520887}]
01gem3gwj0zrc7aev6ym9jfvmk	01g732vctje9f7j72xj5m1hj7k	01ge17pg494yx1s29qycjsjvxp	01ge17rk63nfzk87z1sd4fm5xd	"01g732sftj1w4bq9jd00xjc2xm"	10	f	\N	10	\N
01gem3g6dt59y3pdfx1nzp8y7c	01g7330hg18mh4mt8x5zt9xqvp	01ge17pg494yx1s29qycjsjvxp	01ge17rk63nfzk87z1sd4fm5xd	"01g732xhxshtk694ncpyffveh8"	10	f	\N	10	\N
01gem3gxw6dmeh1zzhcp683e38	01g735txk7r0w6d14d30tqp1zb	01ge17pg494yx1s29qycjsjvxp	01ge17rk63nfzk87z1sd4fm5xd	"Kalimat utama bisa berada di awal sebuah paragraf"	8	t	\N	8	[{"text":"Kalimat utama bisa berada di awal atau akhir sebuah paragraf.","similarity":0.7795729685029128},{"text":"Menemukan kalimat utama yang berisi gagasan pokok.","similarity":0.16475708389497723},{"text":"Membedakan kalimat utama dan penjelas.","similarity":0.21923440971541877},{"text":"Mengetahui jenis paragraf.","similarity":0.11946078283645291},{"text":"Membaca secara intensif isi paragraf, menentukan kalimat utama pada paragraf, menentukan unsur inti kalimat utama","similarity":0.1416064474587855}]
01gem3g4gk54qwac0yb17101n8	01g735rzyztses2fm78rgxm6ec	01ge17pg494yx1s29qycjsjvxp	01ge17rk63nfzk87z1sd4fm5xd	"membaca dengan seksama"	10	t	\N	10	[{"text":"Membaca judul teks","similarity":0.19905123822737344},{"text":"Membaca teks dengan cermat.","similarity":0.19905123822737344},{"text":"Menentukan ide pokok setiap paragra","similarity":0},{"text":"Menandai kata kunci","similarity":0},{"text":"membaca dengan seksama","similarity":1}]
01gem3gv8m15t9sv1m5yrqk4pd	01g735zf1wn3n3a25y8vq8vmg3	01ge17pg494yx1s29qycjsjvxp	01ge17rk63nfzk87z1sd4fm5xd	"gambaran keseluruhan dari paragraf"	10	t	\N	10	[{"text":"gambaran keseluruhan dari suatu paragraf","similarity":1},{"text":"ide\\/gagasan yang menjadi pokok pengembangan paragraf. Gagasan utama terdapat di kalimat utama dan setiap paragraf hanya memiliki satu ide pokok. Berdasarkan letaknya, kalimat utama bisa terdapat pada awal paragraf (paragraf deduktif), akhir paragraf (paragraf induktif), dan awal sekaligus akhir paragraf (Campuran).","similarity":0.021960622481149737},{"text":"Gagasan Utama atau ide pokok merupakan pernyataan yang menjadi inti pembahasan. Gagasan utama terdapat pada kalimat utama dalam setiap paragraf. Letaknya biasanya terdapat pada awal atau akhir paragraf","similarity":0.03620216168368331}]
01gem3g5kvm7kas21fkrpyd4n6	01g735fxanwmxsydzh8yqbd6f3	01ge17pg494yx1s29qycjsjvxp	01ge17rk63nfzk87z1sd4fm5xd	"01g735cwq6v85ttd741et0pk3n"	10	f	\N	10	\N
\.


--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: afrizal
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- Data for Name: kelas; Type: TABLE DATA; Schema: public; Owner: afrizal
--

COPY public.kelas (id, kode_kelas, nama_kelas) FROM stdin;
01g4w9xx1ej4cfj6hawkvkbkg9	6A	6 A
01g4w9y4qqjrdkanc355f33gqy	6B	6 B
01g6qas85p236m57nr72ewcsdg	6C	6 C
\.


--
-- Data for Name: list_jawabansoals; Type: TABLE DATA; Schema: public; Owner: afrizal
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
\.


--
-- Data for Name: mapels; Type: TABLE DATA; Schema: public; Owner: afrizal
--

COPY public.mapels (id, kode_mapel, nama_mapel, kkm_mapel, jumlah_opsi_jawaban, jumlah_pilihan_ganda, jumlah_essai, status_mapel) FROM stdin;
01g732g64qmcd0vs0x3x1aedrz	BHSINDOKLS6A	Bahasa Indonesia Kelas 6	60	4	5	5	t
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: afrizal
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	2014_10_12_000000_create_users_table	1
2	2014_10_12_100000_create_password_resets_table	1
3	2019_08_19_000000_create_failed_jobs_table	1
4	2019_12_14_000001_create_personal_access_tokens_table	1
5	2022_07_03_215439_create_gurus_table	1
6	2022_07_03_215439_create_ikut_ujians_table	1
7	2022_07_03_215439_create_jawaban_ujians_table	1
8	2022_07_03_215439_create_kelas_table	1
9	2022_07_03_215439_create_list_jawabansoals_table	1
10	2022_07_03_215439_create_mapels_table	1
11	2022_07_03_215439_create_nilais_table	1
12	2022_07_03_215439_create_siswas_table	1
13	2022_07_03_215439_create_soals_table	1
14	2022_07_03_215439_create_ujians_table	1
15	2022_07_03_215440_add_foreign_keys_to_gurus_table	1
16	2022_07_03_215440_add_foreign_keys_to_ikut_ujians_table	1
17	2022_07_03_215440_add_foreign_keys_to_jawaban_ujians_table	1
18	2022_07_03_215440_add_foreign_keys_to_list_jawabansoals_table	1
19	2022_07_03_215440_add_foreign_keys_to_nilais_table	1
20	2022_07_03_215440_add_foreign_keys_to_soals_table	1
21	2022_07_03_215440_add_foreign_keys_to_ujians_table	1
22	2022_07_13_175624_create_sessions_table	1
23	2022_09_27_182306_create_soalnya_siswa_ujians_table	1
24	2022_10_12_071831_create_jobs_table	2
\.


--
-- Data for Name: nilais; Type: TABLE DATA; Schema: public; Owner: afrizal
--

COPY public.nilais (id, ujian_id, siswa_id, id_nilai_ujian, nilai_ujian, status_penilaian) FROM stdin;
01gga57md0mtm5mpngt0xjwn6m	01ge17rk63nfzk87z1sd4fm5xd	01ge17pg494yx1s29qycjsjvxp	\N	0	f
\.


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: afrizal
--

COPY public.password_resets (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: afrizal
--

COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: afrizal
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
sy3ahblTVs7Xz90SnR1oRRH65GQI2Rprat3tAfnL	01ge17pg2tw7zktqpbq6xgegjp	192.168.1.254	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36	YTo0OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoianZBVHBRdEJ0NHdJZk1RSXo0T1pjMmZ6ckcxMTk1T25iaTdLekdGdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xOTIuMTY4LjEuMjU0OjgwMDAvZ3VydS9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7czoyNjoiMDFnZTE3cGcydHc3emt0cXBicTZ4Z2VnanAiO30=	1666411615
4VJGxk3rsQ1aXFvn32QHzRulCDFMmk3JCQiPdgfc	\N	192.168.1.254	Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Mobile Safari/537.36	YTozOntzOjY6Il90b2tlbiI7czo0MDoiQktpQkNYYUFyUmt2am81dDVoV1VKeFJSNWdBek1yYnZ2c2FRVjdlUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xOTIuMTY4LjEuMjU0OjgwMDAvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19	1666411638
\.


--
-- Data for Name: siswas; Type: TABLE DATA; Schema: public; Owner: afrizal
--

COPY public.siswas (id, nisn, nama_siswa, tgl_lahir_siswa, alamat_siswa, password, kelas_id) FROM stdin;
01ge17pg4eqcg2sg08czmr5d9z	1Q3Q0B2DY5	Kariman Pradipta	2017-05-31	Ds. Cemara No. 946, Surabaya 35532, Aceh	siswa	01g6qas85p236m57nr72ewcsdg
01ge17pg4hxa2q5rtjemvga7tb	GPEZ0FE2LE	Muhammad Nalar Latupono S.Sos	2016-05-30	Ds. Reksoninten No. 220, Tebing Tinggi 22968, Kepri	siswa	01g4w9xx1ej4cfj6hawkvkbkg9
01ge17pg4k6e98ktnxfpgk8def	XDBSEIZ6KL	Estiawan Wacana	2016-09-16	Dk. Yosodipuro No. 333, Binjai 70158, Sulut	siswa	01g4w9y4qqjrdkanc355f33gqy
01ge17pg4pz6tn7q2rdc9b70ps	3ZACVEIH8X	Maimunah Suci Farida S.E.I	2016-05-30	Jr. Barasak No. 508, Tarakan 69967, Riau	siswa	01g4w9y4qqjrdkanc355f33gqy
01ge17pg4sc2ab0fvdf4zdz65f	Y8I3R1Y1YH	Kartika Yuniar	2017-09-20	Ds. Fajar No. 434, Denpasar 42253, Jabar	siswa	01g4w9y4qqjrdkanc355f33gqy
01ge17pg4vb4f8zf8hpy32cge8	IPG9S3IUY4	Galang Wahyudin	2016-10-30	Dk. Peta No. 418, Denpasar 25196, Jabar	siswa	01g6qas85p236m57nr72ewcsdg
01ge17pg4y2q90zexwmnx6906t	RT7EA9XFXY	Viman Gunawan	2017-10-24	Jr. Bakaru No. 925, Mataram 39534, Sulut	siswa	01g4w9y4qqjrdkanc355f33gqy
01ge17pg513pf0wcsg9zrewjd7	M5I1RQI7JO	Prabowo Manullang	2016-05-30	Gg. Surapati No. 968, Binjai 70863, NTT	siswa	01g4w9y4qqjrdkanc355f33gqy
01ge17pg53yqp36y5vvx2xhbxh	OIZZXU1II7	Nadine Samiah Suartini	2017-12-30	Dk. Tentara Pelajar No. 80, Cimahi 87067, Lampung	siswa	01g4w9xx1ej4cfj6hawkvkbkg9
01ge17pg566req9krjmh17tzkb	456	Aurora Hariyah	2017-05-22	Gg. Raden Saleh No. 403, Manado 58823, Jateng	456	01g6qas85p236m57nr72ewcsdg
01ge17pg494yx1s29qycjsjvxp	123	rizal	2016-11-01	Psr. Ciumbuleuit No. 632, Banjarmasin 59563, Sulteng	123	01g6qas85p236m57nr72ewcsdg
\.


--
-- Data for Name: soalnya_siswa_ujians; Type: TABLE DATA; Schema: public; Owner: afrizal
--

COPY public.soalnya_siswa_ujians (id, siswa_id, ujian_id, listsoal, created_at, updated_at) FROM stdin;
01ge1c3d3emp4t2x6054g7xmpc	01ge17pg494yx1s29qycjsjvxp	01ge17rk63nfzk87z1sd4fm5xd	["01g7330hg18mh4mt8x5zt9xqvp","01g732vctje9f7j72xj5m1hj7k","01g735zf1wn3n3a25y8vq8vmg3","01g735pvg27nnd491j2bj1ctev","01g735fxanwmxsydzh8yqbd6f3","01g735rzyztses2fm78rgxm6ec","01g7362t3yn9qqn8mxy5xj24s8","01g735txk7r0w6d14d30tqp1zb","01g7333r7d726ryh3twg5q38jm","01g7335jr5y1bs76ge2te5efb3"]	2022-09-28 13:21:16	2022-10-26 19:45:48
\.


--
-- Data for Name: soals; Type: TABLE DATA; Schema: public; Owner: afrizal
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
\.


--
-- Data for Name: ujians; Type: TABLE DATA; Schema: public; Owner: afrizal
--

COPY public.ujians (id, mapel_id, guru_id, kelas_id, judul, jenis_ujian, tgl_mulai_ujian, waktu_mulai_ujian, tgl_selesai_ujian, waktu_selesai_ujian, keterlambatan_ujian, code_ujian, status_ujian, status_penilaian_ujian, status_jobs_selesai_ujian) FROM stdin;
01ge17rk63nfzk87z1sd4fm5xd	01g732g64qmcd0vs0x3x1aedrz	01ge17pg2y7hz5q82gxn8s1jaj	01g6qas85p236m57nr72ewcsdg	UH Bahasa Indonesia Kelas 6C	UH	2022-10-21	04:00:00	2022-10-26	23:59:00	1	123	t	f	f
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: afrizal
--

COPY public.users (id, email, username, email_verified_at, password, level, remember_token, created_at, updated_at) FROM stdin;
01ge17pfxz664ak7ckt1xb3chp	me@afrizalmy.com	admin	\N	$2y$10$sm3exkLpqhaVgJB8.P3ZxO8MIYZ9/AS1piNVCeh441LST9XL6bi3a	admin	\N	2022-09-28 12:04:18	2022-09-28 12:04:18
01ge17pg2tw7zktqpbq6xgegjp	guru@afrizalmy.com	guru	\N	$2y$10$oxlUoeT/Fu2rUmhN.L6ajuvxc20Ch1iLV1UdgxEnJ2torEEn/R2fy	guru	\N	2022-09-28 12:04:19	2022-09-28 12:04:19
\.


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: afrizal
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 7, true);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: afrizal
--

SELECT pg_catalog.setval('public.jobs_id_seq', 153, true);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: afrizal
--

SELECT pg_catalog.setval('public.migrations_id_seq', 24, true);


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: afrizal
--

SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: gurus guru_pk; Type: CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.gurus
    ADD CONSTRAINT guru_pk UNIQUE (id);


--
-- Name: ikut_ujians ikut_ujian_pk; Type: CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.ikut_ujians
    ADD CONSTRAINT ikut_ujian_pk UNIQUE (id);


--
-- Name: jawaban_ujians jawaban_ujian_pk; Type: CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.jawaban_ujians
    ADD CONSTRAINT jawaban_ujian_pk UNIQUE (id);


--
-- Name: jawaban_ujians jawaban_ujians_pkey; Type: CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.jawaban_ujians
    ADD CONSTRAINT jawaban_ujians_pkey PRIMARY KEY (id);


--
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: kelas kelas_pk; Type: CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.kelas
    ADD CONSTRAINT kelas_pk UNIQUE (id);


--
-- Name: kelas kelas_pkey; Type: CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.kelas
    ADD CONSTRAINT kelas_pkey PRIMARY KEY (id);


--
-- Name: list_jawabansoals list_jawabansoals_pkey; Type: CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.list_jawabansoals
    ADD CONSTRAINT list_jawabansoals_pkey PRIMARY KEY (id);


--
-- Name: mapels mapel_pk; Type: CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.mapels
    ADD CONSTRAINT mapel_pk UNIQUE (id);


--
-- Name: mapels mapels_pkey; Type: CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.mapels
    ADD CONSTRAINT mapels_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: nilais nilais_pkey; Type: CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.nilais
    ADD CONSTRAINT nilais_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: siswas siswa_pk; Type: CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.siswas
    ADD CONSTRAINT siswa_pk UNIQUE (id);


--
-- Name: soals soal_pk; Type: CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.soals
    ADD CONSTRAINT soal_pk UNIQUE (id);


--
-- Name: soalnya_siswa_ujians soalnya_siswa_ujians_id_unique; Type: CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.soalnya_siswa_ujians
    ADD CONSTRAINT soalnya_siswa_ujians_id_unique UNIQUE (id);


--
-- Name: ujians ujian_pk; Type: CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.ujians
    ADD CONSTRAINT ujian_pk UNIQUE (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: users users_username_unique; Type: CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_unique UNIQUE (username);


--
-- Name: akun_fk; Type: INDEX; Schema: public; Owner: afrizal
--

CREATE INDEX akun_fk ON public.gurus USING btree (user_id);


--
-- Name: hasil_siswa_fk; Type: INDEX; Schema: public; Owner: afrizal
--

CREATE INDEX hasil_siswa_fk ON public.nilais USING btree (siswa_id);


--
-- Name: jawaban_dari_ujian_fk; Type: INDEX; Schema: public; Owner: afrizal
--

CREATE INDEX jawaban_dari_ujian_fk ON public.jawaban_ujians USING btree (ujian_id);


--
-- Name: jawaban_siswa_fk; Type: INDEX; Schema: public; Owner: afrizal
--

CREATE INDEX jawaban_siswa_fk ON public.jawaban_ujians USING btree (siswa_id);


--
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: afrizal
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- Name: membuat_fk; Type: INDEX; Schema: public; Owner: afrizal
--

CREATE INDEX membuat_fk ON public.ujians USING btree (guru_id);


--
-- Name: memiliki_fk; Type: INDEX; Schema: public; Owner: afrizal
--

CREATE INDEX memiliki_fk ON public.ujians USING btree (kelas_id);


--
-- Name: memiliki_jawaban_fk; Type: INDEX; Schema: public; Owner: afrizal
--

CREATE INDEX memiliki_jawaban_fk ON public.jawaban_ujians USING btree (soal_id);


--
-- Name: memiliki_mapel_fk; Type: INDEX; Schema: public; Owner: afrizal
--

CREATE INDEX memiliki_mapel_fk ON public.ujians USING btree (mapel_id);


--
-- Name: memiliki_soal_fk; Type: INDEX; Schema: public; Owner: afrizal
--

CREATE INDEX memiliki_soal_fk ON public.soals USING btree (mapel_id);


--
-- Name: nilai_ujian_siswa_fk; Type: INDEX; Schema: public; Owner: afrizal
--

CREATE INDEX nilai_ujian_siswa_fk ON public.nilais USING btree (ujian_id);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: afrizal
--

CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);


--
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: public; Owner: afrizal
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: afrizal
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: afrizal
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: siswa_ikut_ujian_fk; Type: INDEX; Schema: public; Owner: afrizal
--

CREATE INDEX siswa_ikut_ujian_fk ON public.ikut_ujians USING btree (siswa_id);


--
-- Name: status_ujian_siswa_fk; Type: INDEX; Schema: public; Owner: afrizal
--

CREATE INDEX status_ujian_siswa_fk ON public.ikut_ujians USING btree (ujian_id);


--
-- Name: gurus fk_gurus_akun_users; Type: FK CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.gurus
    ADD CONSTRAINT fk_gurus_akun_users FOREIGN KEY (user_id) REFERENCES public.users(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: ikut_ujians fk_ikut_uji_siswa_iku_siswas; Type: FK CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.ikut_ujians
    ADD CONSTRAINT fk_ikut_uji_siswa_iku_siswas FOREIGN KEY (siswa_id) REFERENCES public.siswas(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: ikut_ujians fk_ikut_uji_status_uj_ujians; Type: FK CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.ikut_ujians
    ADD CONSTRAINT fk_ikut_uji_status_uj_ujians FOREIGN KEY (ujian_id) REFERENCES public.ujians(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: jawaban_ujians fk_jawaban__jawaban_d_ujians; Type: FK CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.jawaban_ujians
    ADD CONSTRAINT fk_jawaban__jawaban_d_ujians FOREIGN KEY (ujian_id) REFERENCES public.ujians(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: jawaban_ujians fk_jawaban__jawaban_s_siswas; Type: FK CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.jawaban_ujians
    ADD CONSTRAINT fk_jawaban__jawaban_s_siswas FOREIGN KEY (siswa_id) REFERENCES public.siswas(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: jawaban_ujians fk_jawaban__memiliki__soals; Type: FK CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.jawaban_ujians
    ADD CONSTRAINT fk_jawaban__memiliki__soals FOREIGN KEY (soal_id) REFERENCES public.soals(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: list_jawabansoals fk_list_jaw_reference_soals; Type: FK CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.list_jawabansoals
    ADD CONSTRAINT fk_list_jaw_reference_soals FOREIGN KEY (soal_id) REFERENCES public.soals(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: nilais fk_nilais_hasil_sis_siswas; Type: FK CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.nilais
    ADD CONSTRAINT fk_nilais_hasil_sis_siswas FOREIGN KEY (siswa_id) REFERENCES public.siswas(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: nilais fk_nilais_nilai_uji_ujians; Type: FK CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.nilais
    ADD CONSTRAINT fk_nilais_nilai_uji_ujians FOREIGN KEY (ujian_id) REFERENCES public.ujians(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: soals fk_soals_memiliki__mapels; Type: FK CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.soals
    ADD CONSTRAINT fk_soals_memiliki__mapels FOREIGN KEY (mapel_id) REFERENCES public.mapels(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: ujians fk_ujians_membuat_gurus; Type: FK CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.ujians
    ADD CONSTRAINT fk_ujians_membuat_gurus FOREIGN KEY (guru_id) REFERENCES public.gurus(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: ujians fk_ujians_memiliki__mapels; Type: FK CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.ujians
    ADD CONSTRAINT fk_ujians_memiliki__mapels FOREIGN KEY (mapel_id) REFERENCES public.mapels(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: ujians fk_ujians_memiliki_kelas; Type: FK CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.ujians
    ADD CONSTRAINT fk_ujians_memiliki_kelas FOREIGN KEY (kelas_id) REFERENCES public.kelas(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: soalnya_siswa_ujians soalnya_siswa_ujians_siswa_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.soalnya_siswa_ujians
    ADD CONSTRAINT soalnya_siswa_ujians_siswa_id_foreign FOREIGN KEY (siswa_id) REFERENCES public.siswas(id) ON DELETE CASCADE;


--
-- Name: soalnya_siswa_ujians soalnya_siswa_ujians_ujian_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: afrizal
--

ALTER TABLE ONLY public.soalnya_siswa_ujians
    ADD CONSTRAINT soalnya_siswa_ujians_ujian_id_foreign FOREIGN KEY (ujian_id) REFERENCES public.ujians(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

