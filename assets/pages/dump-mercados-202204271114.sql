--
-- PostgreSQL database dump
--

-- Dumped from database version 12.9 (Ubuntu 12.9-0ubuntu0.20.04.1)
-- Dumped by pg_dump version 12.9 (Ubuntu 12.9-0ubuntu0.20.04.1)

-- Started on 2022-04-27 11:14:22 -04

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

DROP DATABASE mercados;
--
-- TOC entry 3188 (class 1262 OID 16386)
-- Name: mercados; Type: DATABASE; Schema: -; Owner: -
--

CREATE DATABASE mercados WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'es_BO.UTF-8' LC_CTYPE = 'es_BO.UTF-8';


\connect mercados

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

--
-- TOC entry 3 (class 2615 OID 2200)
-- Name: public; Type: SCHEMA; Schema: -; Owner: -
--

CREATE SCHEMA public;


--
-- TOC entry 3189 (class 0 OID 0)
-- Dependencies: 3
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON SCHEMA public IS 'standard public schema';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 202 (class 1259 OID 16387)
-- Name: acceso; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.acceso (
    id_acceso integer NOT NULL,
    id_cuenta integer NOT NULL,
    id_menu integer NOT NULL,
    permiso character varying(2) DEFAULT 'NO'::character varying NOT NULL,
    actualizado timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    autorizado character varying(100)
);


--
-- TOC entry 203 (class 1259 OID 16392)
-- Name: acceso_id_acceso_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.acceso_id_acceso_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3190 (class 0 OID 0)
-- Dependencies: 203
-- Name: acceso_id_acceso_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.acceso_id_acceso_seq OWNED BY public.acceso.id_acceso;


--
-- TOC entry 218 (class 1259 OID 16491)
-- Name: asociacion; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.asociacion (
    id_asociacion integer NOT NULL,
    nombre character varying(50) NOT NULL,
    registro timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    id_federacion integer NOT NULL,
    estado character varying(2) DEFAULT 'AC'::character varying NOT NULL
);


--
-- TOC entry 217 (class 1259 OID 16489)
-- Name: asociacion_id_asociacion_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.asociacion_id_asociacion_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3191 (class 0 OID 0)
-- Dependencies: 217
-- Name: asociacion_id_asociacion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.asociacion_id_asociacion_seq OWNED BY public.asociacion.id_asociacion;


--
-- TOC entry 225 (class 1259 OID 16553)
-- Name: comerciante; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.comerciante (
    id_mercado integer NOT NULL,
    id_sindicato integer NOT NULL,
    nombres character varying(50) NOT NULL,
    apellidos character varying(75) NOT NULL,
    apellido_casada character varying(25),
    dni character varying(11) NOT NULL,
    id_expedido integer NOT NULL,
    domicilio text NOT NULL,
    foto character varying(25),
    direccion_actividad text NOT NULL,
    superficie character varying(10),
    descripcion text NOT NULL,
    patente character varying(30) NOT NULL,
    registro timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    imagen character varying(25),
    latitud double precision NOT NULL,
    longitud double precision,
    lat double precision NOT NULL,
    lng double precision NOT NULL,
    tipologia character varying(30),
    id_comerciante integer NOT NULL,
    telefono character varying(8),
    fecha date NOT NULL
);


--
-- TOC entry 229 (class 1259 OID 32918)
-- Name: asociado_id_comerciante_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.asociado_id_comerciante_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3192 (class 0 OID 0)
-- Dependencies: 229
-- Name: asociado_id_comerciante_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.asociado_id_comerciante_seq OWNED BY public.comerciante.id_comerciante;


--
-- TOC entry 227 (class 1259 OID 24714)
-- Name: expedido; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.expedido (
    id_expedido integer NOT NULL,
    nombre character varying(25) NOT NULL,
    estado character varying(2) DEFAULT 'AC'::character varying NOT NULL
);


--
-- TOC entry 216 (class 1259 OID 16481)
-- Name: federacion; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.federacion (
    id_federacion integer NOT NULL,
    nombre character varying(100) NOT NULL,
    registro timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    estado character varying(2) DEFAULT 'AC'::character varying NOT NULL
);


--
-- TOC entry 222 (class 1259 OID 16519)
-- Name: mercado; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.mercado (
    id_mercado integer NOT NULL,
    nombre character varying(50) NOT NULL,
    id_tipo_mercado integer NOT NULL,
    latitud real NOT NULL,
    longitud real NOT NULL,
    foto character varying(50) NOT NULL,
    estado character varying(2) DEFAULT 'AC'::character varying,
    page character varying(100)
);


--
-- TOC entry 220 (class 1259 OID 16505)
-- Name: sindicato; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.sindicato (
    id_sindicato integer NOT NULL,
    nombre character varying(50) NOT NULL,
    registro timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    id_asociacion integer NOT NULL,
    estado character varying(2) DEFAULT 'AC'::character varying NOT NULL
);


--
-- TOC entry 230 (class 1259 OID 32929)
-- Name: comerciantes; Type: VIEW; Schema: public; Owner: -
--

CREATE VIEW public.comerciantes AS
 SELECT c.id_comerciante,
    c.dni,
    e.nombre,
    c.nombres,
    c.apellidos,
    c.apellido_casada,
    c.domicilio,
    c.latitud,
    c.longitud,
    c.foto,
    c.tipologia,
    c.patente,
    c.fecha,
    c.superficie,
    c.descripcion,
    c.imagen,
    c.lat,
    c.lng,
    c.direccion_actividad,
    m.nombre AS mercado,
    s.nombre AS sindicato,
    a.nombre AS asociacion,
    f.nombre AS federacion,
    e.nombre AS expedido,
    c.telefono,
    c.id_sindicato,
    c.id_mercado
   FROM (((((public.comerciante c
     LEFT JOIN public.mercado m ON ((c.id_mercado = m.id_mercado)))
     LEFT JOIN public.sindicato s ON ((c.id_sindicato = s.id_sindicato)))
     LEFT JOIN public.asociacion a ON ((s.id_asociacion = a.id_asociacion)))
     LEFT JOIN public.federacion f ON ((a.id_federacion = f.id_federacion)))
     LEFT JOIN public.expedido e ON ((c.id_expedido = e.id_expedido)));


--
-- TOC entry 204 (class 1259 OID 16394)
-- Name: cuenta; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.cuenta (
    id_cuenta integer NOT NULL,
    contrasenia character varying(50) NOT NULL,
    id_persona integer NOT NULL,
    id_rol integer NOT NULL,
    acceso timestamp without time zone,
    habilitado integer DEFAULT 1 NOT NULL
);


--
-- TOC entry 205 (class 1259 OID 16398)
-- Name: cuenta_id_cuenta_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.cuenta_id_cuenta_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3193 (class 0 OID 0)
-- Dependencies: 205
-- Name: cuenta_id_cuenta_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.cuenta_id_cuenta_seq OWNED BY public.cuenta.id_cuenta;


--
-- TOC entry 215 (class 1259 OID 16479)
-- Name: federacion_id_federacion_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.federacion_id_federacion_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3194 (class 0 OID 0)
-- Dependencies: 215
-- Name: federacion_id_federacion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.federacion_id_federacion_seq OWNED BY public.federacion.id_federacion;


--
-- TOC entry 206 (class 1259 OID 16400)
-- Name: menu; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.menu (
    id_menu integer NOT NULL,
    funcionalidad character varying(20) NOT NULL,
    tipo character varying(8) NOT NULL,
    ruta character varying(30),
    icono character varying(100),
    superior integer,
    orden smallint
);


--
-- TOC entry 207 (class 1259 OID 16403)
-- Name: menu_id_menu_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.menu_id_menu_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3195 (class 0 OID 0)
-- Dependencies: 207
-- Name: menu_id_menu_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.menu_id_menu_seq OWNED BY public.menu.id_menu;


--
-- TOC entry 221 (class 1259 OID 16517)
-- Name: mercado_id_mercado_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.mercado_id_mercado_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3196 (class 0 OID 0)
-- Dependencies: 221
-- Name: mercado_id_mercado_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.mercado_id_mercado_seq OWNED BY public.mercado.id_mercado;


--
-- TOC entry 226 (class 1259 OID 24712)
-- Name: newtable_id_expedido_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.newtable_id_expedido_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3197 (class 0 OID 0)
-- Dependencies: 226
-- Name: newtable_id_expedido_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.newtable_id_expedido_seq OWNED BY public.expedido.id_expedido;


--
-- TOC entry 228 (class 1259 OID 24726)
-- Name: organizacion; Type: VIEW; Schema: public; Owner: -
--

CREATE VIEW public.organizacion AS
 SELECT s.id_sindicato,
    s.nombre AS sindicato,
    a.nombre AS asociacion,
    f.nombre AS federacion
   FROM ((public.sindicato s
     LEFT JOIN public.asociacion a ON ((s.id_asociacion = a.id_asociacion)))
     LEFT JOIN public.federacion f ON ((f.id_federacion = a.id_federacion)));


--
-- TOC entry 208 (class 1259 OID 16405)
-- Name: persona; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.persona (
    id_persona integer NOT NULL,
    dni character varying(11) NOT NULL,
    nombre character varying(25) NOT NULL,
    apellido character varying(75) NOT NULL,
    casada character varying(50),
    celular character varying(8) NOT NULL,
    referencia character varying(8),
    registro timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- TOC entry 209 (class 1259 OID 16409)
-- Name: persona_id_persona_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.persona_id_persona_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3198 (class 0 OID 0)
-- Dependencies: 209
-- Name: persona_id_persona_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.persona_id_persona_seq OWNED BY public.persona.id_persona;


--
-- TOC entry 210 (class 1259 OID 16411)
-- Name: predeterminado; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.predeterminado (
    id_predeterminado integer NOT NULL,
    id_rol integer NOT NULL,
    id_menu integer NOT NULL,
    acceso character varying(2) NOT NULL
);


--
-- TOC entry 211 (class 1259 OID 16414)
-- Name: predeterminado_id_predeterminado_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.predeterminado_id_predeterminado_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3199 (class 0 OID 0)
-- Dependencies: 211
-- Name: predeterminado_id_predeterminado_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.predeterminado_id_predeterminado_seq OWNED BY public.predeterminado.id_predeterminado;


--
-- TOC entry 212 (class 1259 OID 16416)
-- Name: rol; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.rol (
    id_rol integer NOT NULL,
    rol character varying(15) NOT NULL,
    estado character varying(2) DEFAULT 'AC'::character varying NOT NULL
);


--
-- TOC entry 213 (class 1259 OID 16420)
-- Name: rol_id_rol_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.rol_id_rol_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3200 (class 0 OID 0)
-- Dependencies: 213
-- Name: rol_id_rol_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.rol_id_rol_seq OWNED BY public.rol.id_rol;


--
-- TOC entry 219 (class 1259 OID 16503)
-- Name: sindicato_id_sindicato_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.sindicato_id_sindicato_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3201 (class 0 OID 0)
-- Dependencies: 219
-- Name: sindicato_id_sindicato_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.sindicato_id_sindicato_seq OWNED BY public.sindicato.id_sindicato;


--
-- TOC entry 224 (class 1259 OID 16528)
-- Name: tipo_mercado; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tipo_mercado (
    id_tipo_mercado integer NOT NULL,
    nombre character varying(30) NOT NULL,
    estado character varying(2) DEFAULT 'AC'::character varying NOT NULL,
    registro timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


--
-- TOC entry 223 (class 1259 OID 16526)
-- Name: tipo_mercado_id_tipo_mercado_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.tipo_mercado_id_tipo_mercado_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3202 (class 0 OID 0)
-- Dependencies: 223
-- Name: tipo_mercado_id_tipo_mercado_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.tipo_mercado_id_tipo_mercado_seq OWNED BY public.tipo_mercado.id_tipo_mercado;


--
-- TOC entry 214 (class 1259 OID 16422)
-- Name: usuarios; Type: VIEW; Schema: public; Owner: -
--

CREATE VIEW public.usuarios AS
 SELECT p.dni,
    concat_ws(' '::text, p.nombre, p.apellido) AS nombre_completo,
    p.casada AS correo,
    p.celular,
    p.referencia,
    r.rol,
    c.acceso,
    c.habilitado,
    c.id_cuenta,
    c.contrasenia,
    row_number() OVER (ORDER BY ( SELECT NULL::text AS text)) AS "row"
   FROM ((public.cuenta c
     LEFT JOIN public.persona p ON ((p.id_persona = c.id_persona)))
     LEFT JOIN public.rol r ON ((r.id_rol = c.id_rol)));


--
-- TOC entry 2959 (class 2604 OID 16427)
-- Name: acceso id_acceso; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.acceso ALTER COLUMN id_acceso SET DEFAULT nextval('public.acceso_id_acceso_seq'::regclass);


--
-- TOC entry 2971 (class 2604 OID 16494)
-- Name: asociacion id_asociacion; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.asociacion ALTER COLUMN id_asociacion SET DEFAULT nextval('public.asociacion_id_asociacion_seq'::regclass);


--
-- TOC entry 2983 (class 2604 OID 32920)
-- Name: comerciante id_comerciante; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.comerciante ALTER COLUMN id_comerciante SET DEFAULT nextval('public.asociado_id_comerciante_seq'::regclass);


--
-- TOC entry 2960 (class 2604 OID 16428)
-- Name: cuenta id_cuenta; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cuenta ALTER COLUMN id_cuenta SET DEFAULT nextval('public.cuenta_id_cuenta_seq'::regclass);


--
-- TOC entry 2984 (class 2604 OID 24717)
-- Name: expedido id_expedido; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.expedido ALTER COLUMN id_expedido SET DEFAULT nextval('public.newtable_id_expedido_seq'::regclass);


--
-- TOC entry 2968 (class 2604 OID 16484)
-- Name: federacion id_federacion; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.federacion ALTER COLUMN id_federacion SET DEFAULT nextval('public.federacion_id_federacion_seq'::regclass);


--
-- TOC entry 2962 (class 2604 OID 16429)
-- Name: menu id_menu; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.menu ALTER COLUMN id_menu SET DEFAULT nextval('public.menu_id_menu_seq'::regclass);


--
-- TOC entry 2977 (class 2604 OID 16522)
-- Name: mercado id_mercado; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.mercado ALTER COLUMN id_mercado SET DEFAULT nextval('public.mercado_id_mercado_seq'::regclass);


--
-- TOC entry 2964 (class 2604 OID 16430)
-- Name: persona id_persona; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.persona ALTER COLUMN id_persona SET DEFAULT nextval('public.persona_id_persona_seq'::regclass);


--
-- TOC entry 2965 (class 2604 OID 16431)
-- Name: predeterminado id_predeterminado; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.predeterminado ALTER COLUMN id_predeterminado SET DEFAULT nextval('public.predeterminado_id_predeterminado_seq'::regclass);


--
-- TOC entry 2967 (class 2604 OID 16432)
-- Name: rol id_rol; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.rol ALTER COLUMN id_rol SET DEFAULT nextval('public.rol_id_rol_seq'::regclass);


--
-- TOC entry 2974 (class 2604 OID 16508)
-- Name: sindicato id_sindicato; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.sindicato ALTER COLUMN id_sindicato SET DEFAULT nextval('public.sindicato_id_sindicato_seq'::regclass);


--
-- TOC entry 2979 (class 2604 OID 16531)
-- Name: tipo_mercado id_tipo_mercado; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tipo_mercado ALTER COLUMN id_tipo_mercado SET DEFAULT nextval('public.tipo_mercado_id_tipo_mercado_seq'::regclass);


--
-- TOC entry 3157 (class 0 OID 16387)
-- Dependencies: 202
-- Data for Name: acceso; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.acceso VALUES (6, 4, 5, 'SI', '2022-03-02 00:10:50.570519', NULL);
INSERT INTO public.acceso VALUES (10, 2, 6, 'NO', '2022-03-11 12:09:58.735737', NULL);
INSERT INTO public.acceso VALUES (12, 2, 7, 'NO', '2022-03-14 15:55:15.009208', NULL);
INSERT INTO public.acceso VALUES (14, 2, 8, 'NO', '2022-03-14 16:28:49.241277', NULL);
INSERT INTO public.acceso VALUES (16, 2, 9, 'NO', '2022-03-15 16:59:21.671391', NULL);
INSERT INTO public.acceso VALUES (17, 2, 10, 'NO', '2022-04-07 16:19:13.929575', NULL);
INSERT INTO public.acceso VALUES (18, 4, 10, 'SI', '2022-04-07 16:19:13.929575', NULL);
INSERT INTO public.acceso VALUES (19, 2, 11, 'NO', '2022-04-07 16:46:42.734308', NULL);
INSERT INTO public.acceso VALUES (20, 4, 11, 'SI', '2022-04-07 16:46:42.734308', NULL);
INSERT INTO public.acceso VALUES (21, 2, 12, 'NO', '2022-04-11 17:02:29.83057', NULL);
INSERT INTO public.acceso VALUES (23, 2, 13, 'NO', '2022-04-11 17:09:26.951431', NULL);
INSERT INTO public.acceso VALUES (24, 4, 13, 'SI', '2022-04-11 17:09:26.951431', NULL);
INSERT INTO public.acceso VALUES (25, 2, 14, 'NO', '2022-04-13 11:53:29.109717', NULL);
INSERT INTO public.acceso VALUES (26, 4, 14, 'SI', '2022-04-13 11:53:29.109717', NULL);
INSERT INTO public.acceso VALUES (27, 2, 15, 'NO', '2022-04-13 15:46:54.948756', NULL);
INSERT INTO public.acceso VALUES (28, 4, 15, 'SI', '2022-04-13 15:46:54.948756', NULL);
INSERT INTO public.acceso VALUES (22, 4, 12, 'SI', '2022-04-11 17:02:29.83057', NULL);
INSERT INTO public.acceso VALUES (29, 2, 16, 'NO', '2022-04-14 10:03:24.338642', NULL);
INSERT INTO public.acceso VALUES (30, 4, 16, 'SI', '2022-04-14 10:03:24.338642', NULL);
INSERT INTO public.acceso VALUES (15, 4, 9, 'NO', '2022-03-15 16:59:21.671391', NULL);
INSERT INTO public.acceso VALUES (31, 2, 17, 'NO', '2022-04-21 17:46:10.230273', NULL);
INSERT INTO public.acceso VALUES (32, 4, 17, 'SI', '2022-04-21 17:46:10.230273', NULL);
INSERT INTO public.acceso VALUES (2, 2, 2, 'NO', '2022-02-24 18:02:56.368732', NULL);
INSERT INTO public.acceso VALUES (1, 2, 1, 'NO', '2022-02-24 18:02:56.368732', NULL);
INSERT INTO public.acceso VALUES (11, 4, 7, 'NO', '2022-03-14 15:55:15.009208', NULL);
INSERT INTO public.acceso VALUES (9, 4, 6, 'NO', '2022-03-11 12:09:58.735737', NULL);
INSERT INTO public.acceso VALUES (38, 5, 5, 'SI', '2022-03-02 00:10:50.570519', NULL);
INSERT INTO public.acceso VALUES (41, 5, 8, 'NO', '2022-03-14 16:28:49.241277', NULL);
INSERT INTO public.acceso VALUES (42, 5, 10, 'SI', '2022-04-07 16:19:13.929575', NULL);
INSERT INTO public.acceso VALUES (43, 5, 11, 'SI', '2022-04-07 16:46:42.734308', NULL);
INSERT INTO public.acceso VALUES (44, 5, 13, 'SI', '2022-04-11 17:09:26.951431', NULL);
INSERT INTO public.acceso VALUES (45, 5, 14, 'SI', '2022-04-13 11:53:29.109717', NULL);
INSERT INTO public.acceso VALUES (46, 5, 15, 'SI', '2022-04-13 15:46:54.948756', NULL);
INSERT INTO public.acceso VALUES (47, 5, 12, 'SI', '2022-04-11 17:02:29.83057', NULL);
INSERT INTO public.acceso VALUES (48, 5, 16, 'SI', '2022-04-14 10:03:24.338642', NULL);
INSERT INTO public.acceso VALUES (49, 5, 9, 'NO', '2022-03-15 16:59:21.671391', NULL);
INSERT INTO public.acceso VALUES (50, 5, 17, 'SI', '2022-04-21 17:46:10.230273', NULL);
INSERT INTO public.acceso VALUES (51, 5, 1, 'NO', '2022-03-02 00:10:50.570519', NULL);
INSERT INTO public.acceso VALUES (52, 5, 4, 'NO', '2022-03-02 00:10:50.57', NULL);
INSERT INTO public.acceso VALUES (8, 4, 4, 'NO', '2022-03-02 00:10:50.57', NULL);
INSERT INTO public.acceso VALUES (39, 5, 6, 'NO', '2022-03-11 12:09:58.735737', NULL);
INSERT INTO public.acceso VALUES (40, 5, 7, 'NO', '2022-03-14 15:55:15.009208', NULL);
INSERT INTO public.acceso VALUES (13, 4, 8, 'SI', '2022-03-14 16:28:49.241277', NULL);
INSERT INTO public.acceso VALUES (53, 6, 1, 'SI', '2022-04-25 16:53:51.751972', NULL);
INSERT INTO public.acceso VALUES (5, 4, 1, 'SI', '2022-03-02 00:10:50.570519', NULL);
INSERT INTO public.acceso VALUES (54, 6, 2, 'NO', '2022-04-25 16:53:51.751972', NULL);
INSERT INTO public.acceso VALUES (3, 2, 3, 'NO', '2022-02-24 18:02:56.368732', NULL);
INSERT INTO public.acceso VALUES (7, 4, 3, 'NO', '2022-03-02 00:10:50.570519', NULL);
INSERT INTO public.acceso VALUES (37, 5, 3, 'NO', '2022-03-02 00:10:50.570519', NULL);
INSERT INTO public.acceso VALUES (55, 6, 3, 'NO', '2022-04-25 16:53:51.751972', NULL);
INSERT INTO public.acceso VALUES (4, 2, 4, 'NO', '2022-02-24 18:02:56.368732', NULL);
INSERT INTO public.acceso VALUES (56, 6, 4, 'NO', '2022-04-25 16:53:51.751972', NULL);


--
-- TOC entry 3172 (class 0 OID 16491)
-- Dependencies: 218
-- Data for Name: asociacion; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.asociacion VALUES (1, 'ASOCIACIÓN DE COMERCIANTES DE LA PAMPA', '2022-04-13 15:32:15.765637', 1, 'AC');


--
-- TOC entry 3179 (class 0 OID 16553)
-- Dependencies: 225
-- Data for Name: comerciante; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.comerciante VALUES (11, 2, 'Yessica', 'Mamani Gomez', 'Bustamante', '794945', 4, 'Zona de Sarco', 'EDjys6aNQB7G1lhV.jpg', 'Calle Lanza N 867', '2x2', 'Venta de Papa', '23634ddf', '2022-04-22 12:00:24.319915', 'EDjys6aNQB7G1lhV.png', -17.414, -66.1653, -17.402100645443415, -66.1522218058932, 'Caseta', 16, '72733342', '2022-05-19');
INSERT INTO public.comerciante VALUES (6, 2, 'Maria Elena', 'Lancia', 'Bustamante', '123456', 1, 'Zona de Sarco', '5OL6QXJTWaSpZGbd.jpg', 'Mercado La Pampa puesto 52', '3x3', 'Venta de Frutas', '12-3-200.00.007-000011', '2022-04-22 17:51:21.13184', '5OL6QXJTWaSpZGbd.png', -17.414, -66.1653, -17.403882008815295, -66.1522316814256, 'Caseta', 17, '68454565', '2022-05-20');
INSERT INTO public.comerciante VALUES (18, 2, 'Alejandro', 'Mamani Gomez', '', '5197168', 2, '710, Tablas, Jayhuayco', '1ctE0F4lgKrxVbzH1.jpg', 'Avenida Petrolera Km 3, Cercado', '2x2', 'Venta de Frutas', '12-3-200.00.007-000030', '2022-04-25 16:39:29.713109', '1ctE0F4lgKrxVbzH.jpg', -17.414, -66.1653, -17.45878861753871, -66.12452002311603, 'Anaquel', 18, '72733342', '2022-05-17');


--
-- TOC entry 3159 (class 0 OID 16394)
-- Dependencies: 204
-- Data for Name: cuenta; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.cuenta VALUES (2, 'a39bb4d6e7f7036c1e5a7192adc56ed0', 1, 1, NULL, 1);
INSERT INTO public.cuenta VALUES (4, 'a39bb4d6e7f7036c1e5a7192adc56ed0', 1, 3, NULL, 1);
INSERT INTO public.cuenta VALUES (5, 'bbb5ff6dc3826b999a5cf0c2e7b2c889', 2, 3, NULL, 1);
INSERT INTO public.cuenta VALUES (6, '17bdb4a43dda403721bd38e41c80578b', 3, 3, NULL, 1);


--
-- TOC entry 3181 (class 0 OID 24714)
-- Dependencies: 227
-- Data for Name: expedido; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.expedido VALUES (1, 'LA PAZ', 'AC');
INSERT INTO public.expedido VALUES (2, 'ORURO', 'AC');
INSERT INTO public.expedido VALUES (3, 'POTOSI', 'AC');
INSERT INTO public.expedido VALUES (4, 'COCHABAMBA', 'AC');
INSERT INTO public.expedido VALUES (5, 'CHUQUISACA', 'AC');
INSERT INTO public.expedido VALUES (6, 'TARIJA', 'AC');
INSERT INTO public.expedido VALUES (7, 'SANTA CRUZ', 'AC');
INSERT INTO public.expedido VALUES (8, 'BENI', 'AC');
INSERT INTO public.expedido VALUES (9, 'PANDO', 'AC');


--
-- TOC entry 3170 (class 0 OID 16481)
-- Dependencies: 216
-- Data for Name: federacion; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.federacion VALUES (1, 'FEDERACION DE COMERCIANTES MINORISTAS VIVANDEROS Y ARTESANOS POR CUENTA PROPIA', '2022-04-13 11:32:19.324398', 'AC');
INSERT INTO public.federacion VALUES (2, 'FEDERACION MANANEROS', '2022-04-25 16:24:21.127721', 'AC');


--
-- TOC entry 3161 (class 0 OID 16400)
-- Dependencies: 206
-- Data for Name: menu; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.menu VALUES (2, 'Datos legales', 'submenu', NULL, '<i class="las la-file-contract"></i>', 1, 1);
INSERT INTO public.menu VALUES (4, 'Cambiar contrasena', 'submenu', NULL, '<i class="las la-exchange-alt"></i>', 1, 2);
INSERT INTO public.menu VALUES (6, 'Menu', 'menu', 'menu', '<i class="las la-bars"></i>', NULL, 2);
INSERT INTO public.menu VALUES (7, 'Crear Menu', 'submenu', 'crear-menu', '<i class="las la-plus-square"></i>', 6, 2);
INSERT INTO public.menu VALUES (9, 'Predeterminado', 'menu', 'menu-predeterminado', '<i class="las la-tasks"></i>', NULL, 3);
INSERT INTO public.menu VALUES (10, 'Mercados', 'menu', 'mercados-municipales', '<i class="las la-shopping-cart"></i>', NULL, 7);
INSERT INTO public.menu VALUES (13, 'Federacion', 'submenu', 'federacion', '<i class="las la-clipboard-list"></i>', 12, 2);
INSERT INTO public.menu VALUES (14, 'Asociacion', 'submenu', 'asociacion', '<i class="las la-sitemap"></i>', 12, 3);
INSERT INTO public.menu VALUES (15, 'Sindicato', 'submenu', 'sindicato', '<i class="las la-users"></i>', 12, 9);
INSERT INTO public.menu VALUES (17, 'Deudas', 'menu', 'deudas', '<i class="las la-file-invoice-dollar"></i>', NULL, 7);
INSERT INTO public.menu VALUES (3, 'Cerrar sesion', 'submenu', 'cerrar-sesion', '<i class="las la-sign-out-alt"></i>', 5, 3);
INSERT INTO public.menu VALUES (11, 'Tipo Mercado', 'submenu', 'tipo-mercado', '<i class="las la-tag"></i>', 10, 6);
INSERT INTO public.menu VALUES (5, 'Usuarios', 'menu', 'usuarios', '<i class="las la-users"></i>', NULL, 9);
INSERT INTO public.menu VALUES (16, 'Comerciantes', 'menu', 'comerciantes', '<i class="las la-people-carry"></i>', NULL, 8);
INSERT INTO public.menu VALUES (8, 'Mapa de mercados', 'submenu', 'mapa-mercados', '<i class="las la-map-marked"></i>', 10, 1);
INSERT INTO public.menu VALUES (12, 'Organizacion', 'menu', NULL, '<i class="las la-sitemap"></i>	', NULL, 7);
INSERT INTO public.menu VALUES (1, 'Inicio', 'menu', 'administrador', '<i class="las la-home"></i>', NULL, 1);


--
-- TOC entry 3176 (class 0 OID 16519)
-- Dependencies: 222
-- Data for Name: mercado; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.mercado VALUES (6, 'LA PAMPA', 1, -17.403625, -66.15212, 'h7Dr5E3wq2tSNWHI.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (8, 'LA PAZ', 1, -17.403564, -66.154236, 'eg7UGZf4VXQlSonF.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (9, 'FIDEL ARANIBAR', 1, -17.402653, -66.1537, 'XOuWbrQwYphU6jPV.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (10, 'CALATAYUD', 1, -17.398354, -66.152824, 'XJMg87s39REm5kKy.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (13, 'AV. REPUBLICA Y AV. PULACAYO', 2, -17.401506, -66.15127, '32xrgzuoGf7bJ1OC.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (14, 'AV. BARRIENTOS', 2, -17.406708, -66.15346, 'WX7vzcCZw3PSltfQ.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (15, 'TRIANGULAR', 2, -17.399029, -66.15024, 'OMEnaSjfqiZpKo47.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (16, 'SAN MARTIN', 2, -17.396347, -66.153625, 'oEKts5BPChxQ9yJX.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (17, 'ESTEBAN ARCE', 2, -17.400728, -66.1552, 'oRLSVINsfaXjgJir.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (18, 'AGUSTIN LOPEZ', 2, -17.402233, -66.15671, 'AauIwUlqF4MP5i1f.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (19, 'C. 25 DE MAYO Y C. PUNATA', 2, -17.40116, -66.15399, 'c1hNkg6M85AqQYDs.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (20, 'CALA CALA', 3, -17.372408, -66.161255, 'p4YMbj0D7s3rEXkO.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (21, '10 DE FEBRERO NORTE', 3, -17.361145, -66.18259, 'FsKbUD1yOt2Wcf9u.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (12, 'MODELO DEL NORTE', 3, -17.351622, -66.17271, '1qUjHCkRuLMi0PZS.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (22, 'VILLA MEXICO', 3, -17.4345, -66.15693, 'QYasGupNvJHq5rE9.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (23, 'TAQUIA', 3, -17.35661, -66.18707, 'zSp67tqDkJ5hmnMw.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (24, 'CAMPESINO', 3, -17.437254, -66.1237, 'DxHvdWAE1y9UG2zZ.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (25, 'BELEN TOKIO', 3, -17.383272, -66.19474, 'ngka2AtHeh3VITxB.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (26, 'EL ARCO', 3, -17.42145, -66.1531, 'DzsbR12EtVGuT9PW.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (27, 'AV. AMERICA Y AV. VILLARROEL', 5, -17.373104, -66.14963, 'WUjqmed6oA03JkOD.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (28, 'AV. HUMBOLDT', 5, -17.390778, -66.16692, 'CMXDO7mh1vxbsLdU.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (29, 'AV. CALAMPAMPA', 5, -17.365343, -66.17174, 'DOe8ScVYlkp5wn6d.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (30, '10 DE FEBRERO SUR', 5, -17.440048, -66.11617, 'bArH4zRxPWVjiJZY.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (31, 'AV. AROMA', 4, -17.399685, -66.15639, 'Twm5lNsARdJZnHMk.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (32, 'AV. AYACUCHO', 4, -17.393194, -66.15863, 'rjStn1OQKLv5Jfeh.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (33, 'AV. BARRIENTOS Y AV. 6 DE AGOSTO', 4, -17.412102, -66.15378, 'J70ajlczXA1doYq2.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (34, 'AV. HEROINAS', 4, -17.392292, -66.15749, 'aHkum7eh5oANd4X2.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (35, 'AV. OQUENDO', 4, -17.39347, -66.14955, 'bLNdp8D19rfIPluv.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (36, 'AV. PULACAYO', 4, -17.404762, -66.15028, 'ejnw96UZhWGIfqs5.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (37, 'AV. REPUBLICA', 4, -17.410107, -66.15079, 'Zd76Tsxt0Wy3a5fE.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (38, 'AV. SILES', 4, -17.405643, -66.1634, 'zO8WGd46QvahcnUg.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (39, 'C. 25 DE MAYO', 4, -17.394894, -66.15514, 'lhyWUKSanIrp9d64.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (40, 'C. AGUSTIN LOPEZ', 4, -17.403145, -66.15661, 'g3Feukm54tcH9VJO.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (41, 'C. CALAMA', 4, -17.395845, -66.15288, '0UK1WIT2iXlPC7Bg.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (42, 'C. ESTEBAN ARCE', 4, -17.400688, -66.15478, 'bFyJqMDQc1CR382w.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (43, 'C. JORDAN', 4, -17.395466, -66.15679, 'nUkLDGoQ7VOZErwj.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (44, 'C. LABISLAO CABRERA', 4, -17.397545, -66.15658, 'p5KW3Sf0tc9adHPN.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (45, 'C. LANZA', 4, -17.397503, -66.1523, 'jBAyN2hlpkqIcnzS.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (46, 'C. MOXOS', 4, -17.406534, -66.14982, '341Kt6GuzLvdnwek.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (47, 'C. PUNATA', 4, -17.402245, -66.15252, 'YdtKhWgAcI56F3DB.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (48, 'C. TOTORA', 4, -17.404999, -66.155975, 'KazSMUBlOtmTRpkg.jpg', 'AC', NULL);
INSERT INTO public.mercado VALUES (11, 'SAN ANTONIO', 1, -17.402428, -66.155945, 'VML7aKTG6tJg8x0n.jpg', 'AC', 'https://comerciantado.com/mercado-san-antonio/');
INSERT INTO public.mercado VALUES (49, 'INGAVI', 3, -17.390238, -66.17106, 'iDxXs6FHtBIQP7pv.jpg', 'AC', NULL);


--
-- TOC entry 3163 (class 0 OID 16405)
-- Dependencies: 208
-- Data for Name: persona; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.persona VALUES (1, '6411602', 'JOHN EVERT', 'ALEMAN ORELLANA', 'john.aleman@outlook.com', '70797239', '61611429', '2022-02-24 17:55:15.466079');
INSERT INTO public.persona VALUES (2, '5197168', 'BRENDA KARINA', 'GARCIA MONTANO', '', '61611429', NULL, '2022-04-24 10:57:27.302314');
INSERT INTO public.persona VALUES (3, '6503231', 'SKARLETH', 'ARTEAGA', '', '65347516', NULL, '2022-04-25 16:53:51.744664');


--
-- TOC entry 3165 (class 0 OID 16411)
-- Dependencies: 210
-- Data for Name: predeterminado; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.predeterminado VALUES (1, 1, 1, 'SI');
INSERT INTO public.predeterminado VALUES (2, 1, 2, 'SI');
INSERT INTO public.predeterminado VALUES (3, 1, 3, 'SI');
INSERT INTO public.predeterminado VALUES (4, 1, 4, 'SI');
INSERT INTO public.predeterminado VALUES (5, 3, 1, 'SI');
INSERT INTO public.predeterminado VALUES (6, 3, 2, 'SI');
INSERT INTO public.predeterminado VALUES (7, 3, 3, 'SI');
INSERT INTO public.predeterminado VALUES (8, 3, 4, 'SI');


--
-- TOC entry 3167 (class 0 OID 16416)
-- Dependencies: 212
-- Data for Name: rol; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.rol VALUES (3, 'ADMINISTRADOR', 'AC');
INSERT INTO public.rol VALUES (1, 'DIRIGENTE', 'AC');


--
-- TOC entry 3174 (class 0 OID 16505)
-- Dependencies: 220
-- Data for Name: sindicato; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.sindicato VALUES (1, 'SINDICATO 23 DE MARZO', '2022-04-13 17:10:54.405887', 1, 'AC');
INSERT INTO public.sindicato VALUES (2, 'SINDICATO 25 DE MAYO', '2022-04-20 10:31:32.477704', 1, 'AC');


--
-- TOC entry 3178 (class 0 OID 16528)
-- Dependencies: 224
-- Data for Name: tipo_mercado; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.tipo_mercado VALUES (2, 'MERCADOS SUB-CENTRALES', 'AC', '2022-04-08 09:22:27.348825');
INSERT INTO public.tipo_mercado VALUES (1, 'MERCADOS CENTRALES', 'AC', '2022-04-08 09:19:13.893782');
INSERT INTO public.tipo_mercado VALUES (4, 'VIAS PUBLICAS', 'AC', '2022-04-20 10:26:05.263685');
INSERT INTO public.tipo_mercado VALUES (5, 'FERIAS FRANCAS', 'AC', '2022-04-21 09:41:50.680354');
INSERT INTO public.tipo_mercado VALUES (3, 'MERCADOS ZONALES', 'AC', '2022-04-08 15:48:00.354705');


--
-- TOC entry 3203 (class 0 OID 0)
-- Dependencies: 203
-- Name: acceso_id_acceso_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.acceso_id_acceso_seq', 56, true);


--
-- TOC entry 3204 (class 0 OID 0)
-- Dependencies: 217
-- Name: asociacion_id_asociacion_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.asociacion_id_asociacion_seq', 1, true);


--
-- TOC entry 3205 (class 0 OID 0)
-- Dependencies: 229
-- Name: asociado_id_comerciante_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.asociado_id_comerciante_seq', 18, true);


--
-- TOC entry 3206 (class 0 OID 0)
-- Dependencies: 205
-- Name: cuenta_id_cuenta_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.cuenta_id_cuenta_seq', 6, true);


--
-- TOC entry 3207 (class 0 OID 0)
-- Dependencies: 215
-- Name: federacion_id_federacion_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.federacion_id_federacion_seq', 2, true);


--
-- TOC entry 3208 (class 0 OID 0)
-- Dependencies: 207
-- Name: menu_id_menu_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.menu_id_menu_seq', 17, true);


--
-- TOC entry 3209 (class 0 OID 0)
-- Dependencies: 221
-- Name: mercado_id_mercado_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.mercado_id_mercado_seq', 49, true);


--
-- TOC entry 3210 (class 0 OID 0)
-- Dependencies: 226
-- Name: newtable_id_expedido_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.newtable_id_expedido_seq', 9, true);


--
-- TOC entry 3211 (class 0 OID 0)
-- Dependencies: 209
-- Name: persona_id_persona_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.persona_id_persona_seq', 3, true);


--
-- TOC entry 3212 (class 0 OID 0)
-- Dependencies: 211
-- Name: predeterminado_id_predeterminado_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.predeterminado_id_predeterminado_seq', 8, true);


--
-- TOC entry 3213 (class 0 OID 0)
-- Dependencies: 213
-- Name: rol_id_rol_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.rol_id_rol_seq', 3, true);


--
-- TOC entry 3214 (class 0 OID 0)
-- Dependencies: 219
-- Name: sindicato_id_sindicato_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.sindicato_id_sindicato_seq', 2, true);


--
-- TOC entry 3215 (class 0 OID 0)
-- Dependencies: 223
-- Name: tipo_mercado_id_tipo_mercado_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.tipo_mercado_id_tipo_mercado_seq', 5, true);


--
-- TOC entry 2987 (class 2606 OID 16434)
-- Name: acceso acceso_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.acceso
    ADD CONSTRAINT acceso_pk PRIMARY KEY (id_acceso);


--
-- TOC entry 3005 (class 2606 OID 16497)
-- Name: asociacion asociacion_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.asociacion
    ADD CONSTRAINT asociacion_pk PRIMARY KEY (id_asociacion);


--
-- TOC entry 3013 (class 2606 OID 32928)
-- Name: comerciante comerciante_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.comerciante
    ADD CONSTRAINT comerciante_pk PRIMARY KEY (id_comerciante);


--
-- TOC entry 2989 (class 2606 OID 16436)
-- Name: cuenta cuenta_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cuenta
    ADD CONSTRAINT cuenta_pk PRIMARY KEY (id_cuenta);


--
-- TOC entry 3003 (class 2606 OID 16488)
-- Name: federacion federacion_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.federacion
    ADD CONSTRAINT federacion_pk PRIMARY KEY (id_federacion);


--
-- TOC entry 2991 (class 2606 OID 16438)
-- Name: menu menu_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.menu
    ADD CONSTRAINT menu_pk PRIMARY KEY (id_menu);


--
-- TOC entry 3009 (class 2606 OID 16525)
-- Name: mercado mercado_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.mercado
    ADD CONSTRAINT mercado_pk PRIMARY KEY (id_mercado);


--
-- TOC entry 3015 (class 2606 OID 24720)
-- Name: expedido newtable_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.expedido
    ADD CONSTRAINT newtable_pk PRIMARY KEY (id_expedido);


--
-- TOC entry 2993 (class 2606 OID 16440)
-- Name: persona persona_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.persona
    ADD CONSTRAINT persona_pk PRIMARY KEY (id_persona);


--
-- TOC entry 2995 (class 2606 OID 16442)
-- Name: persona persona_un; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.persona
    ADD CONSTRAINT persona_un UNIQUE (dni);


--
-- TOC entry 2997 (class 2606 OID 16444)
-- Name: predeterminado predeterminado_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.predeterminado
    ADD CONSTRAINT predeterminado_pk PRIMARY KEY (id_predeterminado);


--
-- TOC entry 2999 (class 2606 OID 16446)
-- Name: rol rol_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.rol
    ADD CONSTRAINT rol_pk PRIMARY KEY (id_rol);


--
-- TOC entry 3001 (class 2606 OID 16448)
-- Name: rol rol_un; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.rol
    ADD CONSTRAINT rol_un UNIQUE (rol);


--
-- TOC entry 3007 (class 2606 OID 16511)
-- Name: sindicato sindicato_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.sindicato
    ADD CONSTRAINT sindicato_pk PRIMARY KEY (id_sindicato);


--
-- TOC entry 3011 (class 2606 OID 16535)
-- Name: tipo_mercado tipo_mercado_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tipo_mercado
    ADD CONSTRAINT tipo_mercado_pk PRIMARY KEY (id_tipo_mercado);


--
-- TOC entry 3022 (class 2606 OID 16498)
-- Name: asociacion asociacion_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.asociacion
    ADD CONSTRAINT asociacion_fk FOREIGN KEY (id_federacion) REFERENCES public.federacion(id_federacion) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 3027 (class 2606 OID 24721)
-- Name: comerciante asociado_expedido_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.comerciante
    ADD CONSTRAINT asociado_expedido_fk FOREIGN KEY (id_expedido) REFERENCES public.expedido(id_expedido) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 3025 (class 2606 OID 16561)
-- Name: comerciante asociado_mercado_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.comerciante
    ADD CONSTRAINT asociado_mercado_fk FOREIGN KEY (id_mercado) REFERENCES public.mercado(id_mercado) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 3026 (class 2606 OID 16571)
-- Name: comerciante asociado_sindicato_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.comerciante
    ADD CONSTRAINT asociado_sindicato_fk FOREIGN KEY (id_sindicato) REFERENCES public.sindicato(id_sindicato) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 3016 (class 2606 OID 16449)
-- Name: acceso cuenta_acceso_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.acceso
    ADD CONSTRAINT cuenta_acceso_fk FOREIGN KEY (id_cuenta) REFERENCES public.cuenta(id_cuenta) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 3017 (class 2606 OID 16454)
-- Name: acceso menu_acceso_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.acceso
    ADD CONSTRAINT menu_acceso_fk FOREIGN KEY (id_menu) REFERENCES public.menu(id_menu) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 3020 (class 2606 OID 16459)
-- Name: predeterminado menu_predeterminado_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.predeterminado
    ADD CONSTRAINT menu_predeterminado_fk FOREIGN KEY (id_menu) REFERENCES public.menu(id_menu) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 3024 (class 2606 OID 16536)
-- Name: mercado mercado_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.mercado
    ADD CONSTRAINT mercado_fk FOREIGN KEY (id_tipo_mercado) REFERENCES public.tipo_mercado(id_tipo_mercado) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 3018 (class 2606 OID 16464)
-- Name: cuenta persona_cuenta_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cuenta
    ADD CONSTRAINT persona_cuenta_fk FOREIGN KEY (id_persona) REFERENCES public.persona(id_persona) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 3019 (class 2606 OID 16469)
-- Name: cuenta rol_cuenta_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cuenta
    ADD CONSTRAINT rol_cuenta_fk FOREIGN KEY (id_rol) REFERENCES public.rol(id_rol) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 3021 (class 2606 OID 16474)
-- Name: predeterminado rol_predeterminado_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.predeterminado
    ADD CONSTRAINT rol_predeterminado_fk FOREIGN KEY (id_rol) REFERENCES public.rol(id_rol) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 3023 (class 2606 OID 16512)
-- Name: sindicato sindicato_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.sindicato
    ADD CONSTRAINT sindicato_fk FOREIGN KEY (id_asociacion) REFERENCES public.asociacion(id_asociacion) ON UPDATE CASCADE ON DELETE RESTRICT;


-- Completed on 2022-04-27 11:14:22 -04

--
-- PostgreSQL database dump complete
--

