--
-- PostgreSQL database dump
--

-- Dumped from database version 12.1
-- Dumped by pg_dump version 12.1

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
-- Name: car; Type: TABLE; Schema: public; Owner: car_user
--

CREATE TABLE public.car (
    id integer NOT NULL,
    brand character varying(255) NOT NULL,
    model character varying(255) NOT NULL,
    year integer NOT NULL,
    equipment character varying(255) NOT NULL,
    specifications json
);


ALTER TABLE public.car OWNER TO car_user;

--
-- Name: car_id_seq; Type: SEQUENCE; Schema: public; Owner: car_user
--

CREATE SEQUENCE public.car_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.car_id_seq OWNER TO car_user;

--
-- Name: car_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: car_user
--

ALTER SEQUENCE public.car_id_seq OWNED BY public.car.id;


--
-- Name: id_seq; Type: SEQUENCE; Schema: public; Owner: car_user
--

CREATE SEQUENCE public.id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.id_seq OWNER TO car_user;

--
-- Name: id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: car_user
--

ALTER SEQUENCE public.id_seq OWNED BY public.car.id;


--
-- Name: storage; Type: TABLE; Schema: public; Owner: car_user
--

CREATE TABLE public.storage (
    id integer NOT NULL,
    car integer NOT NULL,
    status integer NOT NULL,
    count integer NOT NULL
);


ALTER TABLE public.storage OWNER TO car_user;

--
-- Name: storage_id_seq; Type: SEQUENCE; Schema: public; Owner: car_user
--

CREATE SEQUENCE public.storage_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.storage_id_seq OWNER TO car_user;

--
-- Name: storage_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: car_user
--

ALTER SEQUENCE public.storage_id_seq OWNED BY public.storage.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: car_user
--

CREATE TABLE public.users (
    id integer NOT NULL,
    login character varying(255) NOT NULL,
    email character varying(255),
    password character varying(255) NOT NULL,
    role character varying(255) NOT NULL
);


ALTER TABLE public.users OWNER TO car_user;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: car_user
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO car_user;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: car_user
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: car id; Type: DEFAULT; Schema: public; Owner: car_user
--

ALTER TABLE ONLY public.car ALTER COLUMN id SET DEFAULT nextval('public.id_seq'::regclass);


--
-- Name: storage id; Type: DEFAULT; Schema: public; Owner: car_user
--

ALTER TABLE ONLY public.storage ALTER COLUMN id SET DEFAULT nextval('public.storage_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: car_user
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: car; Type: TABLE DATA; Schema: public; Owner: car_user
--

COPY public.car (id, brand, model, year, equipment, specifications) FROM stdin;
5	BMW	750Li	2016	xDrive Long	{"engine": 1.6, "transmission": "automatic", "power": 449, "color": "black", "mileage": 19101}
7	Valkswagen	Golf	2017	Buissines	{"engine": 1.6, "transmission": "automatic", "power": 110, "color": "black", "mileage": 19101}
8	Valkswagen	Jetta	2017	All star	{"engine": 1.6, "transmission": "automatic", "power": 110, "color": "black", "mileage": 19101}
13	Kia	Rio	2019	Top	{\r\n      "engine": 1.6,\r\n      "transmission": "manual",\r\n      "power": 99,\r\n      "color": "white",\r\n      "mileage": 5112\r\n    }
6	Valkswagen	Passat	2015	Comfortline	{"engine": 1.6, "transmission": "manual", "power": 150, "color": "black", "mileage": 19101}
9	Audi	Q7	2019	Advance	{"engine": 2.0, "transmission": "automatic", "power": 252, "color": "silver", "mileage": 20112}
\.


--
-- Data for Name: storage; Type: TABLE DATA; Schema: public; Owner: car_user
--

COPY public.storage (id, car, status, count) FROM stdin;
1	5	2	4
2	7	1	2
3	9	3	10
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: car_user
--

COPY public.users (id, login, email, password, role) FROM stdin;
1	admin	admin@email.com	$2y$10$nao6nPNtm5iH.Jl6Hxp5cuJ00YPkHu.uDLiHIiazFmdy4TZLkj0wq	SUPER_USER
2	manager	manager@email.com	$2y$10$wdGc5B3Zi20z0izVaZ6bsO95QpB/tTOaLzio41a2VxmEx3bsFEV42	MANAGER_USER
3	user	user@email.com	$2y$10$YB3U8E13ayJt1Zex6O9bUue0vJ9xiijrOL.Q3.KOC7rpTqtb4txze	USER
\.


--
-- Name: car_id_seq; Type: SEQUENCE SET; Schema: public; Owner: car_user
--

SELECT pg_catalog.setval('public.car_id_seq', 1, false);


--
-- Name: id_seq; Type: SEQUENCE SET; Schema: public; Owner: car_user
--

SELECT pg_catalog.setval('public.id_seq', 13, true);


--
-- Name: storage_id_seq; Type: SEQUENCE SET; Schema: public; Owner: car_user
--

SELECT pg_catalog.setval('public.storage_id_seq', 3, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: car_user
--

SELECT pg_catalog.setval('public.users_id_seq', 3, true);


--
-- PostgreSQL database dump complete
--

