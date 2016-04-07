--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: dbinvestigacion; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON DATABASE dbinvestigacion IS 'Base de Datos para el Sistema Web del Decanato de Investigación';


--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: autoridad_cargo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE autoridad_cargo (
    des_cargo character varying(50) NOT NULL,
    id_cargo integer NOT NULL
);


ALTER TABLE public.autoridad_cargo OWNER TO postgres;

--
-- Name: TABLE autoridad_cargo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE autoridad_cargo IS 'Tabla para Parametrizar los Cargos de las Autoridades';


--
-- Name: COLUMN autoridad_cargo.des_cargo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN autoridad_cargo.des_cargo IS 'Descripción del Cargo';


--
-- Name: COLUMN autoridad_cargo.id_cargo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN autoridad_cargo.id_cargo IS 'Identificador del Cargo';


--
-- Name: autoridad_cargo_id_cargo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE autoridad_cargo_id_cargo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.autoridad_cargo_id_cargo_seq OWNER TO postgres;

--
-- Name: autoridad_cargo_id_cargo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE autoridad_cargo_id_cargo_seq OWNED BY autoridad_cargo.id_cargo;


--
-- Name: autoridad_email; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE autoridad_email (
    id_autoridad integer NOT NULL,
    email_aut character varying(30) NOT NULL
);


ALTER TABLE public.autoridad_email OWNER TO postgres;

--
-- Name: TABLE autoridad_email; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE autoridad_email IS 'Tabla para guardar los Email de las Autoridades';


--
-- Name: COLUMN autoridad_email.id_autoridad; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN autoridad_email.id_autoridad IS 'Identificador de la Autoridad';


--
-- Name: COLUMN autoridad_email.email_aut; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN autoridad_email.email_aut IS 'Email de la Autoridad';


--
-- Name: autoridad_tel; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE autoridad_tel (
    id_autoridad integer NOT NULL,
    tel_aut character varying(15) NOT NULL
);


ALTER TABLE public.autoridad_tel OWNER TO postgres;

--
-- Name: TABLE autoridad_tel; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE autoridad_tel IS 'Tabla para guardar los teléfonos de las autoridades';


--
-- Name: COLUMN autoridad_tel.id_autoridad; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN autoridad_tel.id_autoridad IS 'Identificador de la Autoridad';


--
-- Name: COLUMN autoridad_tel.tel_aut; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN autoridad_tel.tel_aut IS 'Teléfono de la Autoridad';


--
-- Name: autoridades; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE autoridades (
    id_autoridad integer NOT NULL,
    nom_aut character varying(40) NOT NULL,
    ape_aut character varying(40) NOT NULL,
    foto_aut character varying(100) NOT NULL,
    id_decanato integer,
    id_cargo integer NOT NULL
);


ALTER TABLE public.autoridades OWNER TO postgres;

--
-- Name: TABLE autoridades; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE autoridades IS 'Tabla para Guardar las Autoridades del Decanato';


--
-- Name: COLUMN autoridades.id_autoridad; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN autoridades.id_autoridad IS 'Identificador de la Autoridad';


--
-- Name: COLUMN autoridades.nom_aut; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN autoridades.nom_aut IS 'Nombre de la Autoridad';


--
-- Name: COLUMN autoridades.ape_aut; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN autoridades.ape_aut IS 'Apellidos de la Autoridad';


--
-- Name: COLUMN autoridades.foto_aut; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN autoridades.foto_aut IS 'URL de la Foto de la Autoridad';


--
-- Name: COLUMN autoridades.id_decanato; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN autoridades.id_decanato IS 'Relacion con el Decanato';


--
-- Name: COLUMN autoridades.id_cargo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN autoridades.id_cargo IS 'Codigo del Cargo';


--
-- Name: autoridades_id_autoridad_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE autoridades_id_autoridad_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.autoridades_id_autoridad_seq OWNER TO postgres;

--
-- Name: autoridades_id_autoridad_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE autoridades_id_autoridad_seq OWNED BY autoridades.id_autoridad;


--
-- Name: centros; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE centros (
    id_centro integer NOT NULL,
    nom_centro character varying(150) NOT NULL,
    vision_centro text NOT NULL,
    mision_centro text NOT NULL,
    objetivos text,
    director_centro character varying(150) NOT NULL,
    valores_cen text,
    tel_dir_cen character varying(15),
    email_dir_cen character varying(30),
    id_decanato integer
);


ALTER TABLE public.centros OWNER TO postgres;

--
-- Name: TABLE centros; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE centros IS 'Tabla para Guardar los Centros de Investigación';


--
-- Name: COLUMN centros.id_centro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN centros.id_centro IS 'Identificador del Centro';


--
-- Name: COLUMN centros.nom_centro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN centros.nom_centro IS 'Nombre del Centro';


--
-- Name: COLUMN centros.vision_centro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN centros.vision_centro IS 'Visión del Centro';


--
-- Name: COLUMN centros.mision_centro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN centros.mision_centro IS 'Mision del Centro';


--
-- Name: COLUMN centros.objetivos; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN centros.objetivos IS 'Objetivos del Centro de Investigación';


--
-- Name: COLUMN centros.director_centro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN centros.director_centro IS 'Nombre completo del Director del Centro';


--
-- Name: COLUMN centros.valores_cen; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN centros.valores_cen IS 'Valores del Centro';


--
-- Name: COLUMN centros.tel_dir_cen; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN centros.tel_dir_cen IS 'Teléfono del Director';


--
-- Name: COLUMN centros.email_dir_cen; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN centros.email_dir_cen IS 'Correo del Director';


--
-- Name: centros_id_centro_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE centros_id_centro_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.centros_id_centro_seq OWNER TO postgres;

--
-- Name: centros_id_centro_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE centros_id_centro_seq OWNED BY centros.id_centro;


--
-- Name: esp_inv; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE esp_inv (
    des_esp character varying(255) NOT NULL,
    id_esp integer NOT NULL
);


ALTER TABLE public.esp_inv OWNER TO postgres;

--
-- Name: TABLE esp_inv; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE esp_inv IS 'Tabla para parametrizar las especialidades de los investigadores';


--
-- Name: COLUMN esp_inv.des_esp; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN esp_inv.des_esp IS 'Descripción de la especialidad';


--
-- Name: COLUMN esp_inv.id_esp; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN esp_inv.id_esp IS 'Codigo de la Especialidad';


--
-- Name: esp_inv_id_esp_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE esp_inv_id_esp_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.esp_inv_id_esp_seq OWNER TO postgres;

--
-- Name: esp_inv_id_esp_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE esp_inv_id_esp_seq OWNED BY esp_inv.id_esp;


--
-- Name: evento_area; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE evento_area (
    des_area character varying(200) NOT NULL,
    id_area integer NOT NULL
);


ALTER TABLE public.evento_area OWNER TO postgres;

--
-- Name: TABLE evento_area; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE evento_area IS 'Tabla para parametrizar las Áreas académicas';


--
-- Name: COLUMN evento_area.des_area; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN evento_area.des_area IS 'Descripción del Area';


--
-- Name: COLUMN evento_area.id_area; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN evento_area.id_area IS 'Codigo del Area';


--
-- Name: evento_area_id_area_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE evento_area_id_area_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.evento_area_id_area_seq OWNER TO postgres;

--
-- Name: evento_area_id_area_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE evento_area_id_area_seq OWNED BY evento_area.id_area;


--
-- Name: evento_espacio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE evento_espacio (
    des_espacio character varying(40) NOT NULL,
    id_espacio integer NOT NULL
);


ALTER TABLE public.evento_espacio OWNER TO postgres;

--
-- Name: TABLE evento_espacio; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE evento_espacio IS 'Tabla para guardar los espacios';


--
-- Name: COLUMN evento_espacio.des_espacio; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN evento_espacio.des_espacio IS 'Descripción o Nombre del Espacio';


--
-- Name: COLUMN evento_espacio.id_espacio; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN evento_espacio.id_espacio IS 'Codigo del Espacio';


--
-- Name: evento_espacio_id_espacio_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE evento_espacio_id_espacio_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.evento_espacio_id_espacio_seq OWNER TO postgres;

--
-- Name: evento_espacio_id_espacio_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE evento_espacio_id_espacio_seq OWNED BY evento_espacio.id_espacio;


--
-- Name: evento_info; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE evento_info (
    id integer NOT NULL,
    id_evento integer NOT NULL,
    fecha date NOT NULL,
    hora integer NOT NULL
);


ALTER TABLE public.evento_info OWNER TO postgres;

--
-- Name: TABLE evento_info; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE evento_info IS 'Tabla para Guardar Fechas y Horas de Eventos';


--
-- Name: COLUMN evento_info.id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN evento_info.id IS 'Identificador Único de registro';


--
-- Name: COLUMN evento_info.id_evento; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN evento_info.id_evento IS 'Codigo del Evento';


--
-- Name: COLUMN evento_info.fecha; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN evento_info.fecha IS 'Fecha';


--
-- Name: COLUMN evento_info.hora; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN evento_info.hora IS 'Hora del Evento';


--
-- Name: evento_info_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE evento_info_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.evento_info_id_seq OWNER TO postgres;

--
-- Name: evento_info_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE evento_info_id_seq OWNED BY evento_info.id;


--
-- Name: evento_publico; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE evento_publico (
    des_publico character varying(200) NOT NULL,
    id_publico integer NOT NULL
);


ALTER TABLE public.evento_publico OWNER TO postgres;

--
-- Name: TABLE evento_publico; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE evento_publico IS 'Tabla para parametrizar los tipos de públicos';


--
-- Name: COLUMN evento_publico.des_publico; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN evento_publico.des_publico IS 'Descripción del tipo de público';


--
-- Name: COLUMN evento_publico.id_publico; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN evento_publico.id_publico IS 'Codigo del Publico';


--
-- Name: evento_publico_id_publico_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE evento_publico_id_publico_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.evento_publico_id_publico_seq OWNER TO postgres;

--
-- Name: evento_publico_id_publico_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE evento_publico_id_publico_seq OWNED BY evento_publico.id_publico;


--
-- Name: evento_tipo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE evento_tipo (
    des_tipo character varying(200) NOT NULL,
    id_tipo integer NOT NULL
);


ALTER TABLE public.evento_tipo OWNER TO postgres;

--
-- Name: TABLE evento_tipo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE evento_tipo IS 'Tabla para parametrizar los tipos de eventos';


--
-- Name: COLUMN evento_tipo.des_tipo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN evento_tipo.des_tipo IS 'Descripción del Tipo';


--
-- Name: COLUMN evento_tipo.id_tipo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN evento_tipo.id_tipo IS 'Codigo del Tipo';


--
-- Name: evento_tipo_id_tipo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE evento_tipo_id_tipo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.evento_tipo_id_tipo_seq OWNER TO postgres;

--
-- Name: evento_tipo_id_tipo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE evento_tipo_id_tipo_seq OWNED BY evento_tipo.id_tipo;


--
-- Name: eventos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE eventos (
    id_evento integer NOT NULL,
    nom_evento character varying(100) NOT NULL,
    obj_evento text NOT NULL,
    pon_evento text,
    inversion double precision,
    est_evento character(1) NOT NULL,
    id_area integer,
    id_publico integer,
    id_tipo integer,
    id_espacio integer,
    CONSTRAINT ckest_eve CHECK ((((est_evento = 'A'::bpchar) OR (est_evento = 'E'::bpchar)) OR (est_evento = 'R'::bpchar)))
);


ALTER TABLE public.eventos OWNER TO postgres;

--
-- Name: TABLE eventos; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE eventos IS 'Tabla para Guardar Eventos Aprobados';


--
-- Name: COLUMN eventos.id_evento; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN eventos.id_evento IS 'Identificador del Evento';


--
-- Name: COLUMN eventos.nom_evento; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN eventos.nom_evento IS 'Nombre del Evento';


--
-- Name: COLUMN eventos.obj_evento; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN eventos.obj_evento IS 'Objetivos del Evento';


--
-- Name: COLUMN eventos.pon_evento; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN eventos.pon_evento IS 'Ponentes del Evento';


--
-- Name: COLUMN eventos.inversion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN eventos.inversion IS 'Monto de la Inversión del Evento';


--
-- Name: COLUMN eventos.est_evento; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN eventos.est_evento IS 'Estado del Evento: A->Aprobado, E->En Evaluacion, R->No aprobado';


--
-- Name: COLUMN eventos.id_area; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN eventos.id_area IS 'Codigo del Area';


--
-- Name: COLUMN eventos.id_publico; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN eventos.id_publico IS 'Codigo del Publico';


--
-- Name: COLUMN eventos.id_tipo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN eventos.id_tipo IS 'Codigo del Tipo';


--
-- Name: COLUMN eventos.id_espacio; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN eventos.id_espacio IS 'Codigo del Espacio';


--
-- Name: eventos_id_evento_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE eventos_id_evento_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.eventos_id_evento_seq OWNER TO postgres;

--
-- Name: eventos_id_evento_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE eventos_id_evento_seq OWNED BY eventos.id_evento;


--
-- Name: info_decanato; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE info_decanato (
    id_decanato integer NOT NULL,
    mision text NOT NULL,
    vision text NOT NULL,
    fec_ult_act date NOT NULL,
    email_dec character varying(40) NOT NULL
);


ALTER TABLE public.info_decanato OWNER TO postgres;

--
-- Name: TABLE info_decanato; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE info_decanato IS 'Tabla para Guardar Información General del Decanato';


--
-- Name: COLUMN info_decanato.id_decanato; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN info_decanato.id_decanato IS 'Identificador del Decanato, para efectos de normalizacion';


--
-- Name: COLUMN info_decanato.mision; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN info_decanato.mision IS 'Mision del Decanato';


--
-- Name: COLUMN info_decanato.vision; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN info_decanato.vision IS 'Visión del Decanato';


--
-- Name: COLUMN info_decanato.fec_ult_act; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN info_decanato.fec_ult_act IS 'Fecha de la Última Actualización que sufrió la Información';


--
-- Name: COLUMN info_decanato.email_dec; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN info_decanato.email_dec IS 'Email del Decanato';


--
-- Name: info_decanato_id_decanato_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE info_decanato_id_decanato_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.info_decanato_id_decanato_seq OWNER TO postgres;

--
-- Name: info_decanato_id_decanato_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE info_decanato_id_decanato_seq OWNED BY info_decanato.id_decanato;


--
-- Name: info_decanato_imagen; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE info_decanato_imagen (
    id_imagen integer NOT NULL,
    imagen character varying(255) NOT NULL,
    des_img character varying(200) NOT NULL,
    id_decanato integer
);


ALTER TABLE public.info_decanato_imagen OWNER TO postgres;

--
-- Name: TABLE info_decanato_imagen; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE info_decanato_imagen IS 'Tabla para Guardar las Imágenes del Carousel de Inicio';


--
-- Name: COLUMN info_decanato_imagen.id_imagen; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN info_decanato_imagen.id_imagen IS 'Identificador de la Imagen';


--
-- Name: COLUMN info_decanato_imagen.imagen; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN info_decanato_imagen.imagen IS 'URL de la Imagen';


--
-- Name: COLUMN info_decanato_imagen.des_img; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN info_decanato_imagen.des_img IS 'Breve Descripción de la Imagen';


--
-- Name: COLUMN info_decanato_imagen.id_decanato; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN info_decanato_imagen.id_decanato IS 'Identificador del Decanato';


--
-- Name: info_decanato_imagen_id_imagen_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE info_decanato_imagen_id_imagen_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.info_decanato_imagen_id_imagen_seq OWNER TO postgres;

--
-- Name: info_decanato_imagen_id_imagen_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE info_decanato_imagen_id_imagen_seq OWNED BY info_decanato_imagen.id_imagen;


--
-- Name: info_decanato_jor; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE info_decanato_jor (
    id_jornada integer NOT NULL,
    pro_jor character varying(100),
    norm_jor character varying(100),
    mem_jor character varying(100),
    fecha_jor date,
    id_decanato integer,
    nom_jor character varying(255)
);


ALTER TABLE public.info_decanato_jor OWNER TO postgres;

--
-- Name: TABLE info_decanato_jor; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE info_decanato_jor IS 'Tabla para guardar la informacion de las jornadas';


--
-- Name: COLUMN info_decanato_jor.id_jornada; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN info_decanato_jor.id_jornada IS 'Identificador de la jornada';


--
-- Name: COLUMN info_decanato_jor.pro_jor; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN info_decanato_jor.pro_jor IS 'Url del PDF de la programación de la jornada';


--
-- Name: COLUMN info_decanato_jor.norm_jor; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN info_decanato_jor.norm_jor IS 'Url del PDF de la normativa de la jornada';


--
-- Name: COLUMN info_decanato_jor.mem_jor; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN info_decanato_jor.mem_jor IS 'URL del PDF de las memorias de las jornadas';


--
-- Name: COLUMN info_decanato_jor.fecha_jor; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN info_decanato_jor.fecha_jor IS 'Año de la Jornada';


--
-- Name: COLUMN info_decanato_jor.id_decanato; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN info_decanato_jor.id_decanato IS 'Identificador del Decanato';


--
-- Name: COLUMN info_decanato_jor.nom_jor; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN info_decanato_jor.nom_jor IS 'Nombre de la Jornada';


--
-- Name: info_decanato_jor_id_jornada_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE info_decanato_jor_id_jornada_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.info_decanato_jor_id_jornada_seq OWNER TO postgres;

--
-- Name: info_decanato_jor_id_jornada_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE info_decanato_jor_id_jornada_seq OWNED BY info_decanato_jor.id_jornada;


--
-- Name: info_decanato_norma; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE info_decanato_norma (
    des_norma text NOT NULL,
    id_norma integer NOT NULL,
    id_espacio integer
);


ALTER TABLE public.info_decanato_norma OWNER TO postgres;

--
-- Name: TABLE info_decanato_norma; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE info_decanato_norma IS 'Para Parametrización de las Normas para Usar el Decanato';


--
-- Name: COLUMN info_decanato_norma.des_norma; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN info_decanato_norma.des_norma IS 'Descripción de la Norma';


--
-- Name: COLUMN info_decanato_norma.id_norma; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN info_decanato_norma.id_norma IS 'Codigo de la Norma';


--
-- Name: COLUMN info_decanato_norma.id_espacio; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN info_decanato_norma.id_espacio IS 'Codigo del Espacio';


--
-- Name: info_decanato_norma_id_norma_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE info_decanato_norma_id_norma_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.info_decanato_norma_id_norma_seq OWNER TO postgres;

--
-- Name: info_decanato_norma_id_norma_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE info_decanato_norma_id_norma_seq OWNED BY info_decanato_norma.id_norma;


--
-- Name: info_decanato_prog; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE info_decanato_prog (
    des_prog character varying(100) NOT NULL,
    mision_prog text,
    vision_prog text,
    id_decanato integer,
    id_prog integer NOT NULL
);


ALTER TABLE public.info_decanato_prog OWNER TO postgres;

--
-- Name: TABLE info_decanato_prog; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE info_decanato_prog IS 'Tabla para Guardar los programas del decanato';


--
-- Name: COLUMN info_decanato_prog.des_prog; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN info_decanato_prog.des_prog IS 'Descripción o nombre del programa';


--
-- Name: COLUMN info_decanato_prog.mision_prog; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN info_decanato_prog.mision_prog IS 'Mision del Programa';


--
-- Name: COLUMN info_decanato_prog.vision_prog; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN info_decanato_prog.vision_prog IS 'Vision del Programa';


--
-- Name: COLUMN info_decanato_prog.id_decanato; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN info_decanato_prog.id_decanato IS 'identificador del Decanato';


--
-- Name: COLUMN info_decanato_prog.id_prog; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN info_decanato_prog.id_prog IS 'Codigo del Programa';


--
-- Name: info_decanato_prog_id_prog_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE info_decanato_prog_id_prog_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.info_decanato_prog_id_prog_seq OWNER TO postgres;

--
-- Name: info_decanato_prog_id_prog_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE info_decanato_prog_id_prog_seq OWNED BY info_decanato_prog.id_prog;


--
-- Name: investigador_email; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE investigador_email (
    id_investigador integer NOT NULL,
    email_inv character varying(30) NOT NULL
);


ALTER TABLE public.investigador_email OWNER TO postgres;

--
-- Name: TABLE investigador_email; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE investigador_email IS 'Tabla para guardar los correos de los investigadores';


--
-- Name: COLUMN investigador_email.id_investigador; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN investigador_email.id_investigador IS 'Identificador del Investigador';


--
-- Name: COLUMN investigador_email.email_inv; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN investigador_email.email_inv IS 'Email del Investigador';


--
-- Name: investigador_esp; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE investigador_esp (
    id_investigador integer NOT NULL,
    id_esp integer NOT NULL
);


ALTER TABLE public.investigador_esp OWNER TO postgres;

--
-- Name: TABLE investigador_esp; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE investigador_esp IS 'Tabla para asociar los investigadores con las especialidades';


--
-- Name: COLUMN investigador_esp.id_investigador; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN investigador_esp.id_investigador IS 'Idenficador del Investigador';


--
-- Name: COLUMN investigador_esp.id_esp; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN investigador_esp.id_esp IS 'Codigo de la Especialidad';


--
-- Name: investigador_tel; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE investigador_tel (
    id_investigador integer NOT NULL,
    tel_inv character varying(15) NOT NULL
);


ALTER TABLE public.investigador_tel OWNER TO postgres;

--
-- Name: TABLE investigador_tel; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE investigador_tel IS 'Tabla para guardar los teléfonos de los investigadores';


--
-- Name: COLUMN investigador_tel.id_investigador; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN investigador_tel.id_investigador IS 'Identificador del Investigador';


--
-- Name: COLUMN investigador_tel.tel_inv; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN investigador_tel.tel_inv IS 'Telefonos de los Investigadores';


--
-- Name: investigadores; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE investigadores (
    id_investigador integer NOT NULL,
    nom_inv character varying(40) NOT NULL,
    ape_inv character varying(40) NOT NULL,
    des_inv text NOT NULL,
    foto_inv character varying(255),
    id_centro integer,
    id_prog integer NOT NULL
);


ALTER TABLE public.investigadores OWNER TO postgres;

--
-- Name: TABLE investigadores; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE investigadores IS 'Tabla de Investigadores';


--
-- Name: COLUMN investigadores.id_investigador; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN investigadores.id_investigador IS 'Idenficador del Investigador';


--
-- Name: COLUMN investigadores.nom_inv; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN investigadores.nom_inv IS 'Nombres del Investigador';


--
-- Name: COLUMN investigadores.ape_inv; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN investigadores.ape_inv IS 'Apellidos del Investigador';


--
-- Name: COLUMN investigadores.des_inv; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN investigadores.des_inv IS 'Descripción del Investigador';


--
-- Name: COLUMN investigadores.foto_inv; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN investigadores.foto_inv IS 'URL de la foto del investigador';


--
-- Name: COLUMN investigadores.id_centro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN investigadores.id_centro IS 'Identificador del Centro';


--
-- Name: COLUMN investigadores.id_prog; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN investigadores.id_prog IS 'Codigo del Programa';


--
-- Name: investigadores_id_investigador_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE investigadores_id_investigador_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.investigadores_id_investigador_seq OWNER TO postgres;

--
-- Name: investigadores_id_investigador_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE investigadores_id_investigador_seq OWNED BY investigadores.id_investigador;


--
-- Name: lineas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE lineas (
    id_linea integer NOT NULL,
    nom_lin character varying(100) NOT NULL,
    des_lin text,
    id_centro integer,
    id_prog integer
);


ALTER TABLE public.lineas OWNER TO postgres;

--
-- Name: TABLE lineas; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE lineas IS 'Tabla para Guardar las Líneas de Investigación';


--
-- Name: COLUMN lineas.id_linea; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN lineas.id_linea IS 'Identificador de la linea';


--
-- Name: COLUMN lineas.nom_lin; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN lineas.nom_lin IS 'Nombre de la línea';


--
-- Name: COLUMN lineas.des_lin; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN lineas.des_lin IS 'Descripción de la línea';


--
-- Name: COLUMN lineas.id_centro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN lineas.id_centro IS 'Identificador del Centro';


--
-- Name: COLUMN lineas.id_prog; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN lineas.id_prog IS 'Codigo del Programa';


--
-- Name: lineas_id_linea_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE lineas_id_linea_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.lineas_id_linea_seq OWNER TO postgres;

--
-- Name: lineas_id_linea_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE lineas_id_linea_seq OWNED BY lineas.id_linea;


--
-- Name: modulos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE modulos (
    cod_mod character varying(3) NOT NULL,
    des_mod character varying(50) NOT NULL
);


ALTER TABLE public.modulos OWNER TO postgres;

--
-- Name: TABLE modulos; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE modulos IS 'Tabla de Módulos';


--
-- Name: COLUMN modulos.cod_mod; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN modulos.cod_mod IS 'Código del Módulo';


--
-- Name: COLUMN modulos.des_mod; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN modulos.des_mod IS 'Descripción del Modulo';


--
-- Name: movimiento_usuario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE movimiento_usuario (
    cod_mov character varying(3),
    id_usuario integer NOT NULL,
    fec_mov date NOT NULL,
    hor_mov time without time zone NOT NULL,
    id_movimiento_usu integer NOT NULL
);


ALTER TABLE public.movimiento_usuario OWNER TO postgres;

--
-- Name: TABLE movimiento_usuario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE movimiento_usuario IS 'Bitacora de Movimientos por Usuario';


--
-- Name: COLUMN movimiento_usuario.cod_mov; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN movimiento_usuario.cod_mov IS 'Codigo del Movimiento';


--
-- Name: COLUMN movimiento_usuario.id_usuario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN movimiento_usuario.id_usuario IS 'Identificador del Usuario';


--
-- Name: COLUMN movimiento_usuario.fec_mov; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN movimiento_usuario.fec_mov IS 'Fecha del Movimiento';


--
-- Name: COLUMN movimiento_usuario.hor_mov; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN movimiento_usuario.hor_mov IS 'Hora del Movimiento';


--
-- Name: COLUMN movimiento_usuario.id_movimiento_usu; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN movimiento_usuario.id_movimiento_usu IS 'Identificador del Movimiento';


--
-- Name: movimiento_usuario_id_movimiento_usu_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE movimiento_usuario_id_movimiento_usu_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.movimiento_usuario_id_movimiento_usu_seq OWNER TO postgres;

--
-- Name: movimiento_usuario_id_movimiento_usu_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE movimiento_usuario_id_movimiento_usu_seq OWNED BY movimiento_usuario.id_movimiento_usu;


--
-- Name: movimientos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE movimientos (
    cod_mov character varying(3) NOT NULL,
    cod_mod character varying(3) NOT NULL,
    des_mov character varying(60) NOT NULL
);


ALTER TABLE public.movimientos OWNER TO postgres;

--
-- Name: TABLE movimientos; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE movimientos IS 'Tabla de Movimientos. Bitacora del Sistema';


--
-- Name: COLUMN movimientos.cod_mov; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN movimientos.cod_mov IS 'Codigo del Movimiento';


--
-- Name: COLUMN movimientos.cod_mod; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN movimientos.cod_mod IS 'Código del Módulo';


--
-- Name: COLUMN movimientos.des_mov; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN movimientos.des_mov IS 'Descripción del Movimiento';


--
-- Name: noaprob_causa; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE noaprob_causa (
    des_causa character varying(255) NOT NULL,
    id_causa integer NOT NULL
);


ALTER TABLE public.noaprob_causa OWNER TO postgres;

--
-- Name: TABLE noaprob_causa; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE noaprob_causa IS 'Tabla para parametrizar las Causas de NO aprobación';


--
-- Name: COLUMN noaprob_causa.des_causa; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN noaprob_causa.des_causa IS 'Descripción de la Causa';


--
-- Name: COLUMN noaprob_causa.id_causa; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN noaprob_causa.id_causa IS 'Codigo de la Causa';


--
-- Name: noaprob_causa_id_causa_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE noaprob_causa_id_causa_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.noaprob_causa_id_causa_seq OWNER TO postgres;

--
-- Name: noaprob_causa_id_causa_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE noaprob_causa_id_causa_seq OWNED BY noaprob_causa.id_causa;


--
-- Name: noticia_img; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE noticia_img (
    id_noticia integer NOT NULL,
    img_not character varying(255) NOT NULL
);


ALTER TABLE public.noticia_img OWNER TO postgres;

--
-- Name: TABLE noticia_img; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE noticia_img IS 'Tabla para guardar las imágenes de las Noticias';


--
-- Name: COLUMN noticia_img.id_noticia; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN noticia_img.id_noticia IS 'Identificador de la Noticia';


--
-- Name: COLUMN noticia_img.img_not; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN noticia_img.img_not IS 'URL de la imagen de la noticia';


--
-- Name: noticias; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE noticias (
    id_noticia integer NOT NULL,
    titulo character varying(255) NOT NULL,
    des_not text NOT NULL,
    fec_not date NOT NULL,
    id_decanato integer
);


ALTER TABLE public.noticias OWNER TO postgres;

--
-- Name: TABLE noticias; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE noticias IS 'Tabla para Guardar las Noticias Que se Mostrarán en el Inicio';


--
-- Name: COLUMN noticias.id_noticia; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN noticias.id_noticia IS 'Identificador de la Noticia';


--
-- Name: COLUMN noticias.titulo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN noticias.titulo IS 'Título de la Noticia';


--
-- Name: COLUMN noticias.des_not; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN noticias.des_not IS 'Desarrollo de la Noticia';


--
-- Name: COLUMN noticias.fec_not; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN noticias.fec_not IS 'Fecha de la Noticia';


--
-- Name: COLUMN noticias.id_decanato; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN noticias.id_decanato IS 'Identificador del Decanato';


--
-- Name: noticias_id_noticia_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE noticias_id_noticia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.noticias_id_noticia_seq OWNER TO postgres;

--
-- Name: noticias_id_noticia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE noticias_id_noticia_seq OWNED BY noticias.id_noticia;


--
-- Name: permisos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE permisos (
    id_usuario integer NOT NULL,
    cod_mod character varying(3) NOT NULL
);


ALTER TABLE public.permisos OWNER TO postgres;

--
-- Name: TABLE permisos; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE permisos IS 'Tabla de permisos';


--
-- Name: COLUMN permisos.id_usuario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN permisos.id_usuario IS 'Identificador del Usuario';


--
-- Name: COLUMN permisos.cod_mod; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN permisos.cod_mod IS 'codigo del modulo';


--
-- Name: proyecto_inv; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE proyecto_inv (
    id_proyecto integer NOT NULL,
    id_investigador integer NOT NULL
);


ALTER TABLE public.proyecto_inv OWNER TO postgres;

--
-- Name: TABLE proyecto_inv; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE proyecto_inv IS 'Tabla para Guardar los Investigadoresde cada proyecto';


--
-- Name: COLUMN proyecto_inv.id_proyecto; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN proyecto_inv.id_proyecto IS 'Identificador del Proyecto';


--
-- Name: COLUMN proyecto_inv.id_investigador; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN proyecto_inv.id_investigador IS 'Idenficador del Investigador';


--
-- Name: proyecto_tipo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE proyecto_tipo (
    des_tipo_pro character varying(40),
    id_tipo_pro integer NOT NULL
);


ALTER TABLE public.proyecto_tipo OWNER TO postgres;

--
-- Name: TABLE proyecto_tipo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE proyecto_tipo IS 'Tabla para parametrizar los tipos de proyectos';


--
-- Name: COLUMN proyecto_tipo.des_tipo_pro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN proyecto_tipo.des_tipo_pro IS 'Descripción del tipo de proyecto';


--
-- Name: COLUMN proyecto_tipo.id_tipo_pro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN proyecto_tipo.id_tipo_pro IS 'Identificador del Tipo de Proyecto';


--
-- Name: proyecto_tipo_id_tipo_pro_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE proyecto_tipo_id_tipo_pro_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.proyecto_tipo_id_tipo_pro_seq OWNER TO postgres;

--
-- Name: proyecto_tipo_id_tipo_pro_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE proyecto_tipo_id_tipo_pro_seq OWNED BY proyecto_tipo.id_tipo_pro;


--
-- Name: proyectos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE proyectos (
    id_proyecto integer NOT NULL,
    tit_pro character varying(255) NOT NULL,
    obj_pro text,
    fec_ini_pro date,
    fec_cul_pro date,
    id_linea integer NOT NULL,
    id_centro integer,
    id_tipo_pro integer NOT NULL,
    id_prog integer NOT NULL
);


ALTER TABLE public.proyectos OWNER TO postgres;

--
-- Name: TABLE proyectos; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE proyectos IS 'Tabla para Guardar los Proyectos';


--
-- Name: COLUMN proyectos.id_proyecto; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN proyectos.id_proyecto IS 'Identificador del Proyecto';


--
-- Name: COLUMN proyectos.tit_pro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN proyectos.tit_pro IS 'Titulo del Proyecto';


--
-- Name: COLUMN proyectos.obj_pro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN proyectos.obj_pro IS 'Objetivos del Proyecto.';


--
-- Name: COLUMN proyectos.fec_ini_pro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN proyectos.fec_ini_pro IS 'Fecha de Inicio del Proyecto';


--
-- Name: COLUMN proyectos.fec_cul_pro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN proyectos.fec_cul_pro IS 'Fecha de Culminación del Proyecto';


--
-- Name: COLUMN proyectos.id_linea; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN proyectos.id_linea IS 'Identificador de la Linea';


--
-- Name: COLUMN proyectos.id_centro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN proyectos.id_centro IS 'Identificador del Centro';


--
-- Name: COLUMN proyectos.id_tipo_pro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN proyectos.id_tipo_pro IS 'Codigo del Tipo';


--
-- Name: COLUMN proyectos.id_prog; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN proyectos.id_prog IS 'Codigo del Programa';


--
-- Name: proyectos_id_proyecto_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE proyectos_id_proyecto_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.proyectos_id_proyecto_seq OWNER TO postgres;

--
-- Name: proyectos_id_proyecto_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE proyectos_id_proyecto_seq OWNED BY proyectos.id_proyecto;


--
-- Name: solic_esp; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE solic_esp (
    cod_sol character varying(20) NOT NULL,
    nom_solicitante character varying(40) NOT NULL,
    ape_solicitante character varying(40) NOT NULL,
    ced_solicitante character varying(10) NOT NULL,
    tel_solicitante character varying(15) NOT NULL,
    est_sol character(1) DEFAULT 'E'::bpchar NOT NULL,
    fec_sol date NOT NULL,
    id_evento integer NOT NULL,
    id_causa integer,
    interes boolean NOT NULL,
    CONSTRAINT ckest_sol CHECK ((((est_sol = 'A'::bpchar) OR (est_sol = 'R'::bpchar)) OR (est_sol = 'E'::bpchar)))
);


ALTER TABLE public.solic_esp OWNER TO postgres;

--
-- Name: TABLE solic_esp; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE solic_esp IS 'Tabla de Solicitudes para el Auditorio';


--
-- Name: COLUMN solic_esp.cod_sol; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN solic_esp.cod_sol IS 'Código de la Solicitud';


--
-- Name: COLUMN solic_esp.nom_solicitante; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN solic_esp.nom_solicitante IS 'Nombres del Solicitante';


--
-- Name: COLUMN solic_esp.ape_solicitante; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN solic_esp.ape_solicitante IS 'Apellidos del Solicitante';


--
-- Name: COLUMN solic_esp.ced_solicitante; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN solic_esp.ced_solicitante IS 'Cédula del Solicitante';


--
-- Name: COLUMN solic_esp.tel_solicitante; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN solic_esp.tel_solicitante IS 'Teléfono del Solicitante';


--
-- Name: COLUMN solic_esp.est_sol; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN solic_esp.est_sol IS 'Estado de la Solicitud. A->Aprobada, R->No Aprobada, E->En Evaluación';


--
-- Name: COLUMN solic_esp.fec_sol; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN solic_esp.fec_sol IS 'Fecha de la Solicitud';


--
-- Name: COLUMN solic_esp.id_evento; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN solic_esp.id_evento IS 'Identificador del Evento';


--
-- Name: COLUMN solic_esp.id_causa; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN solic_esp.id_causa IS 'Codigo de la Causa';


--
-- Name: COLUMN solic_esp.interes; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN solic_esp.interes IS 'Campo para guardar el dato bool sobre si confirmo o no interes';


--
-- Name: usuario_email; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE usuario_email (
    id_usuario integer NOT NULL,
    email_usu character varying(30) NOT NULL
);


ALTER TABLE public.usuario_email OWNER TO postgres;

--
-- Name: TABLE usuario_email; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE usuario_email IS 'Tabla para Almacenar los Correos de los Usuarios';


--
-- Name: COLUMN usuario_email.id_usuario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario_email.id_usuario IS 'Referencia al Identificador del Usuario';


--
-- Name: COLUMN usuario_email.email_usu; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario_email.email_usu IS 'Email del Usuario';


--
-- Name: usuario_tel; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE usuario_tel (
    id_usuario integer NOT NULL,
    tel_usu character varying(15) NOT NULL
);


ALTER TABLE public.usuario_tel OWNER TO postgres;

--
-- Name: TABLE usuario_tel; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE usuario_tel IS 'Tabla para Almacenar los Telefonos de los Usuarios';


--
-- Name: COLUMN usuario_tel.id_usuario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario_tel.id_usuario IS 'Identificador del Usuario';


--
-- Name: COLUMN usuario_tel.tel_usu; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario_tel.tel_usu IS 'Teléfono del Usuario';


--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE usuarios (
    id_usuario integer NOT NULL,
    usuario character varying(40) NOT NULL,
    clave character varying(100) NOT NULL,
    nom_usu character varying(40) NOT NULL,
    ape_usu character varying(40) NOT NULL,
    estado character(1) NOT NULL,
    CONSTRAINT check_estado CHECK (((estado = 'A'::bpchar) OR (estado = 'I'::bpchar)))
);


ALTER TABLE public.usuarios OWNER TO postgres;

--
-- Name: TABLE usuarios; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE usuarios IS 'Tabla para Almacenar los Usuarios del Sistema';


--
-- Name: COLUMN usuarios.id_usuario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuarios.id_usuario IS 'Identificador del Usuario';


--
-- Name: COLUMN usuarios.usuario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuarios.usuario IS 'Nombre de Acceso del Usuario';


--
-- Name: COLUMN usuarios.clave; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuarios.clave IS 'Clave de Acceso al Sistemaa';


--
-- Name: COLUMN usuarios.nom_usu; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuarios.nom_usu IS 'Nombre de Pila del Usuario';


--
-- Name: COLUMN usuarios.ape_usu; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuarios.ape_usu IS 'Apellidos del Usuarios';


--
-- Name: COLUMN usuarios.estado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuarios.estado IS 'Estado del Usuario, A->Activo, I->Inactivo';


--
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE usuarios_id_usuario_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuarios_id_usuario_seq OWNER TO postgres;

--
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE usuarios_id_usuario_seq OWNED BY usuarios.id_usuario;


--
-- Name: id_cargo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY autoridad_cargo ALTER COLUMN id_cargo SET DEFAULT nextval('autoridad_cargo_id_cargo_seq'::regclass);


--
-- Name: id_autoridad; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY autoridades ALTER COLUMN id_autoridad SET DEFAULT nextval('autoridades_id_autoridad_seq'::regclass);


--
-- Name: id_centro; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY centros ALTER COLUMN id_centro SET DEFAULT nextval('centros_id_centro_seq'::regclass);


--
-- Name: id_esp; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY esp_inv ALTER COLUMN id_esp SET DEFAULT nextval('esp_inv_id_esp_seq'::regclass);


--
-- Name: id_area; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evento_area ALTER COLUMN id_area SET DEFAULT nextval('evento_area_id_area_seq'::regclass);


--
-- Name: id_espacio; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evento_espacio ALTER COLUMN id_espacio SET DEFAULT nextval('evento_espacio_id_espacio_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evento_info ALTER COLUMN id SET DEFAULT nextval('evento_info_id_seq'::regclass);


--
-- Name: id_publico; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evento_publico ALTER COLUMN id_publico SET DEFAULT nextval('evento_publico_id_publico_seq'::regclass);


--
-- Name: id_tipo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evento_tipo ALTER COLUMN id_tipo SET DEFAULT nextval('evento_tipo_id_tipo_seq'::regclass);


--
-- Name: id_evento; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY eventos ALTER COLUMN id_evento SET DEFAULT nextval('eventos_id_evento_seq'::regclass);


--
-- Name: id_decanato; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY info_decanato ALTER COLUMN id_decanato SET DEFAULT nextval('info_decanato_id_decanato_seq'::regclass);


--
-- Name: id_imagen; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY info_decanato_imagen ALTER COLUMN id_imagen SET DEFAULT nextval('info_decanato_imagen_id_imagen_seq'::regclass);


--
-- Name: id_jornada; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY info_decanato_jor ALTER COLUMN id_jornada SET DEFAULT nextval('info_decanato_jor_id_jornada_seq'::regclass);


--
-- Name: id_norma; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY info_decanato_norma ALTER COLUMN id_norma SET DEFAULT nextval('info_decanato_norma_id_norma_seq'::regclass);


--
-- Name: id_prog; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY info_decanato_prog ALTER COLUMN id_prog SET DEFAULT nextval('info_decanato_prog_id_prog_seq'::regclass);


--
-- Name: id_investigador; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY investigadores ALTER COLUMN id_investigador SET DEFAULT nextval('investigadores_id_investigador_seq'::regclass);


--
-- Name: id_linea; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY lineas ALTER COLUMN id_linea SET DEFAULT nextval('lineas_id_linea_seq'::regclass);


--
-- Name: id_movimiento_usu; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY movimiento_usuario ALTER COLUMN id_movimiento_usu SET DEFAULT nextval('movimiento_usuario_id_movimiento_usu_seq'::regclass);


--
-- Name: id_causa; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY noaprob_causa ALTER COLUMN id_causa SET DEFAULT nextval('noaprob_causa_id_causa_seq'::regclass);


--
-- Name: id_noticia; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY noticias ALTER COLUMN id_noticia SET DEFAULT nextval('noticias_id_noticia_seq'::regclass);


--
-- Name: id_tipo_pro; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyecto_tipo ALTER COLUMN id_tipo_pro SET DEFAULT nextval('proyecto_tipo_id_tipo_pro_seq'::regclass);


--
-- Name: id_proyecto; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyectos ALTER COLUMN id_proyecto SET DEFAULT nextval('proyectos_id_proyecto_seq'::regclass);


--
-- Name: id_usuario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuarios ALTER COLUMN id_usuario SET DEFAULT nextval('usuarios_id_usuario_seq'::regclass);


--
-- Data for Name: autoridad_cargo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY autoridad_cargo (des_cargo, id_cargo) FROM stdin;
Director de Investigación	12
Directora de Extensión	20
Decano de Investigación y Extensión	1
Director de Administración	22
\.


--
-- Name: autoridad_cargo_id_cargo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('autoridad_cargo_id_cargo_seq', 23, true);


--
-- Data for Name: autoridad_email; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY autoridad_email (id_autoridad, email_aut) FROM stdin;
26	hsas2@jaskas.com
27	kaas2kajsas@laksas.com
27	sasksas@kakjska.com
31	uncorreo@jahsas.com
31	otrocorro@ajhsas.com
31	masque@jahsas.com
\.


--
-- Data for Name: autoridad_tel; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY autoridad_tel (id_autoridad, tel_aut) FROM stdin;
25	04125424424
31	04125424424
31	09212123333
\.


--
-- Data for Name: autoridades; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY autoridades (id_autoridad, nom_aut, ape_aut, foto_aut, id_decanato, id_cargo) FROM stdin;
26	Dr Juana	Bastidas	2-6-2015-22:34:34asas.jpg	1	20
27	Dr Elvi	Bello	2-6-2015-23:35:38asasas.jpg	1	12
25	Juan	Perez	16-6-2015-22:54:21Foto-carnet.jpg	1	1
31	Un Nombre	un Apellido	16-6-2015-23:26:13asasasas.jpg	1	22
\.


--
-- Name: autoridades_id_autoridad_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('autoridades_id_autoridad_seq', 31, true);


--
-- Data for Name: centros; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY centros (id_centro, nom_centro, vision_centro, mision_centro, objetivos, director_centro, valores_cen, tel_dir_cen, email_dir_cen, id_decanato) FROM stdin;
9	Estación Piscícola Dr. Armando Gámez	<p><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">Incentivar a los productores a la implantaci&oacute;n de un plan integral de desarrollo acu&iacute;cola de los diferentes estados y en el cual participen instituciones que tengan competencia, para que el cultivo de organismos acu&aacute;ticos, con &eacute;nfasis en peces se consolide ya no como actividad de subsistencias paternalistas sino integradas a las unidades de producci&oacute;n agr&iacute;cola para aumentar la disponibilidad de alimento optimizando el uso de los </span><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">recursos agua, tierra, capital y mano de obra que se traduzca en el mejoramiento socioecon&oacute;mico de la poblaci&oacute;n Unergista conjuntamente con el desarrollo integral del Estado.</span></p>\r\n	<p><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">La Estaci&oacute;n Experimental Pisc&iacute;cola Dr. Armando G&aacute;mez, tiene como misi&oacute;n proporcionar Tecnolog&iacute;as que son socialmente aceptables, ambientalmente conservacionistas, tecnol&oacute;gicamente aplicables y econ&oacute;micamente rentables a la comunidad Unergista y a la poblaci&oacute;n en general a trav&eacute;s de sus programas de Investigaci&oacute;n, Extensi&oacute;n, Docencia y Producci&oacute;n.</span></p>\r\n	<p><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">&bull; Realizar programas de extensi&oacute;n a trav&eacute;s de actividades pisc&iacute;colas como fuente alterna de prote&iacute;na de bajo costo a nivel del grande, mediano y peque&ntilde;o productor a fin de incorporarlos en la producci&oacute;n de los recursos &iacute;cticos de nuestra zona.</span></p>\r\n\r\n<p><span class="html-tag" style="font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;"><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">&bull; Efectuar programas de producci&oacute;n desarrollando cultivos comerciales de las diferentes especies y sus h&iacute;bridos a fin de abastecer la demanda de alevines exigida por los distintos productores para su posterior cultivo.</span></span></p>\r\n\r\n<p><span class="html-tag" style="font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;"><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">&bull; Formar talento humano a trav&eacute;s de la docencia a nivel universitario, t&eacute;cnico y obrero que generen un mayor desarrollo de la producci&oacute;n pisc&iacute;cola interna de nuestra naci&oacute;n.</span></span></p>\r\n	Ing. Milagros Hernández	<p><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">Compromiso: disponer de todas nuestras capacidades para cumplir con las actividades haciendo m&aacute;s de lo esperado a fin de lograr el crecimiento del centro de producci&oacute;n.</span><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">Responsabilidad: somos responsables y solidarios con la sociedad, el ambiente, los trabajadores, los estudiantes y productores.</span><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">Calidad: proporcionar conocimientos y alimentos que satisfagan las expectativas de los estudiantes, productores y comunidad en general.</span><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">Vocaci&oacute;n de servicio: Satisfacer con nuestro trabajo las necesidades acad&eacute;micas de nuestros estudiantes, mediante un contacto interpersonal y humano.</span><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">Trabajo en equipo: amortizar las atribuciones de los trabajadores a fin de lograr ofrecer un buen servicio acad&eacute;mico y productivo.</span><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">Sentido pr&aacute;ctico: aplicar el sentido com&uacute;n con acierto, con base en la experiencia y habilidad para responder con oportunidad y atender los problemas que se presenten.</span></p>\r\n			1
10	Centro de Estudios e Investigación del Área Ciencias de la Educación Rómulo Gallegos (CEIACERG)	<p><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">Promover, impulsar, divulgar y fortalecer la investigaci&oacute;n para proporcionar soluciones te&oacute;ricas y pr&aacute;cticas a problemas de estudios propios de las ciencias de la educaci&oacute;n y del comportamiento humano, esto es investigaciones que respondan a un alto contenido de calidad pero al mismo tiempo arraigadas a la pertinencia sociopol&iacute;tica que transciendan de lo individual para dar paso a lo colectivo y social de la educaci&oacute;n.</span></p>\r\n	<p><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">Ser una unidad org&aacute;nica administrativa de compromiso, calidad y excelencia que brinde soluciones cient&iacute;ficas tecnol&oacute;gicas a las realidades sociales de la regi&oacute;n y al Estado venezolano en materia de educaci&oacute;n.</span></p>\r\n	<p><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">Ser una unidad org&aacute;nica administrativa de compromiso, calidad y excelencia que brinde soluciones cient&iacute;ficas tecnol&oacute;gicas a las realidades sociales de la regi&oacute;n y al Estado venezolano en materia de educaci&oacute;n.</span></p>\r\n	Fulano de Tal	<p><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">Desde los albores del quehacer investigativo y el estudio de la filosof&iacute;a de la Ciencia y la Axiolog&iacute;a, se busca para comprender los valores presentes en la pr&aacute;ctica cient&iacute;fica, se requiere establecer la relaci&oacute;n entre &eacute;tica e investigaci&oacute;n, poniendo &eacute;nfasis en la integridad en las acciones y sus opuestos, por esa raz&oacute;n, el CENTRO DE ESTUDIOS E INVESTIGACI&Oacute;N DEL &Aacute;REA CIENCIAS DE LA EDUCACI&Oacute;N R&Oacute;MULO GALLEGOS, considera que la formaci&oacute;n de los nuevos cient&iacute;ficos debe hacerse, mediante un proceso de socializaci&oacute;n e interacci&oacute;n con los investigadores consolidados y su participaci&oacute;n en la comunidad cient&iacute;fica.</span><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">Obviamente, Ciencia, investigaci&oacute;n y valores, son elementos b&aacute;sicos, para entender c&oacute;mo asumen los investigadores su papel en la pr&aacute;ctica cotidiana, al estar presentes en la toma de decisiones sobre qu&eacute; investigar y c&oacute;mo hacerlo, en la b&uacute;squeda del conocimiento &uacute;til y en beneficio de la sociedad, as&iacute; como en la manifestaci&oacute;n de la honestidad en sus acciones al querer y hacer investigaci&oacute;n de la mejor manera posible, de ese modo los valores que se impulsan y practican desde CEIACERG engloban compromiso, honestidad, responsabilidad, solidaridad, cooperaci&oacute;n e integraci&oacute;n.</span></p>\r\n			1
11	Instituto para el Desarrollo Sostenible de los Sistemas Agroambientales (IDESSA)	<p><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">&bull; Ejercer papel rector en la creaci&oacute;n de conocimientos, aplicaci&oacute;n e innovaci&oacute;n de tecnolog&iacute;as en el &aacute;rea de los Sistemas Agroambientales.</span><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">&bull; Utilizar como herramienta para la comprensi&oacute;n de la realidad regional, nacional el enfoque hol&iacute;stico, interdisciplinario e interinstitucional.</span><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">&bull; Apoyar la formaci&oacute;n acad&eacute;mica-cient&iacute;fica, nivel t&eacute;cnico, de especial</span><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">izaci&oacute;n y postgrado</span><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">&bull; Ejercer e impulsar una pol&iacute;tica en la generaci&oacute;n de conocimientos y desarrollo de tecnolog&iacute;as.</span></p>\r\n	<p><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">Generar conocimientos y desarrollar tecnolog&iacute;as que enfrenten los problemas de los sistemas agroambientales desde sus diversas dimensiones (agroecol&oacute;gica, sociocultural, tecnol&oacute;gica, econ&oacute;mica y pol&iacute;tica) que permitan insertar la Universidad con el desarrollo econ&oacute;mico, social, regional y nacional.</span></p>\r\n	<p><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">&bull; Consolidar la labor de los grupos y centros de estudios de la UNERG que lleven a cabo proyectos de innovaci&oacute;n y desarrollo tecnol&oacute;gico interdisciplinarios e interinstitucionales que hayan avanzado y logrado estabilizarse en l&iacute;neas de trabajo relacionadas con los sistemas agroambientales.</span><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">&bull; Estimular la organizaci&oacute;n de equipos de investigadores, interdisciplinarios e interinstitucionales, en campos de estudios relacionados con los sistemas agroambientales.</span><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">&bull; Contribuir a la formaci&oacute;n cient&iacute;fico-acad&eacute;mica en las diferentes &aacute;reas de los sistemas agroambientales en particular, y de cualquier &aacute;rea de la ciencia en general.</span><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">&bull; Estimular la formulaci&oacute;n y ejecuci&oacute;n de proyectos participativos de desarrollo tecnol&oacute;gico y extensi&oacute;n, enmarcados en un programa institucional como l&iacute;neas fundamentales de trabajo, de car&aacute;cter interdisciplinario e interinstitucional.</span><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">&bull; Promover la formaci&oacute;n de personal t&eacute;cnico calificado en las &aacute;reas de competencia del Instituto para el servicio de la actividad cient&iacute;fica, desarrollo tecnol&oacute;gico, extensi&oacute;n y asistencia t&eacute;cnica.</span><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">&bull; Ofrecer a trav&eacute;s de sus niveles de adscripci&oacute;n, asistencia y asesor&iacute;a te&oacute;rico/pr&aacute;ctica permanente u ocasional, a otras dependencias y/o instituciones que los soliciten en las &aacute;reas de competencias del Instituto.</span><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">&bull; Promover y organizar eventos cient&iacute;ficos y tecnol&oacute;gicos vinculados con los sistemas agroambientales y otras &aacute;reas de inter&eacute;s conexas.</span><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">&bull; Apoyar la creaci&oacute;n y consolidaci&oacute;n de los centros de producci&oacute;n de la UNERG, relacionados con las l&iacute;neas de altos estudios afines al IDESSA.</span></p>\r\n	Dr Pedro Peña	<p><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">El IDESSA est&aacute; integrado por miembros honestos, disciplinados, comprometidos, sensibles a la problem&aacute;tica de los sistemas agroambientales.</span><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">&bull; Es amplio y flexible, con una divisi&oacute;n arm&oacute;nica del trabajo que da cabida a los representantes del sector productivo en la definici&oacute;n de las pol&iacute;ticas y planes de desarrollo.</span><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">&bull; Cuenta con docentes investigadores de alto nivel, capaz de renovarse, producir, y aplicar resultados acordes a las necesidades de la comunidad.</span><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">&bull; Posee una pol&iacute;tica definida de captaci&oacute;n y formaci&oacute;n de talentos humanos a los fines de consolidar el funcionamiento.</span><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">&bull; Basado en tecnolog&iacute;a de informaci&oacute;n y comunicaci&oacute;n alternativa, es un ente de vanguardia que garantiza elevar los niveles de productividad cient&iacute;fica y a la vez posibilita la difusi&oacute;n e intercambio permanente de nuevos conocimientos con los beneficiarios de las acciones del mismo.</span></p>\r\n	12121212121		1
8	Centro Jardín Botánico de la Universidad Nacional Experimental Rómulo Gallegos	<p><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">El Centro Jard&iacute;n Bot&aacute;nico de la Universidad &quot;R&oacute;mulo Gallegos se concibe bajo la &oacute;ptica de un ente educativo basado en la colecci&oacute;n de especies vegetales aut&oacute;ctonas e introducidas orientado hacia el mejoramiento del ejercicio cient&iacute;fico en materia bot&aacute;nica.</span></p>\r\n\r\n<p><span class="html-tag" style="font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;"><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">Las visitas guiadas para la comunidad tanto intra como extra Universitaria ofrece a los usuarios la interacci&oacute;n Ambiente &ndash; Sociedad como componente de la Educaci&oacute;n Ambiental; obteni&eacute;ndose una mayor comprensi&oacute;n del equilibrio de la naturaleza en la conformaci&oacute;n de diversos ecosistemas.</span><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">En el &aacute;mbito deportivo, recreativo y cultural se cuenta con espacios dentro de un marco paisaj&iacute;stico de armon&iacute;a donde los elementos naturales y artificiales se integran para el disfrute de los visitantes.</span></span></p>\r\n	<p><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">Contribuir significativamente en la preservaci&oacute;n, uso y divulgaci&oacute;n de las especies vegetales.</span></p>\r\n\r\n<p><span class="html-tag" style="font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;"><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">Proporcionar informaci&oacute;n relacionada al &aacute;mbito bot&aacute;nico-ecol&oacute;gico para el desarrollo de investigaciones cient&iacute;ficas y t&eacute;cnicas.</span></span></p>\r\n\r\n<p><span class="html-tag" style="font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;"><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">Mantener contacto permanente con el p&uacute;blico bajo enfoque de Educaci&oacute;n Ambiental.</span></span></p>\r\n\r\n<p><span class="html-tag" style="font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;"><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">Establecer relaciones Interinstitucionales que fomenten el crecimiento y desarrollo de los organismos participantes</span></span></p>\r\n	<p><strong><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">Objetivos del &aacute;rea laboral</span></strong><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">Tiene como principal objetivo mantener los bancos de Germoplasma, tanto de especies nativas como ex&oacute;ticas, de importancia agronom&iacute;a, medicinales y ornamentales.</span><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">Ser un centro educativo dedicado al estudio de m&uacute;ltiples aspectos relativos a la aclimataci&oacute;n y condiciones de vida, tanto de las plantas propias de la zona, como de otras &aacute;reas geogr&aacute;ficas del mundo.</span><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">La labor principal se orienta hacia el mejoramiento del ejercicio cient&iacute;fico en materia bot&aacute;nica y hacia la integraci&oacute;n del medio ambiente con la comunidad.</span><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">Es un espacio que busca transformar el &aacute;rea en un centro recreacional y cultural con jardines y colecciones de especies nativas y ex&oacute;ticas, colocadas cient&iacute;fica y paisaj&iacute;sticamente para el disfrute de los visitantes.</span><br />\r\n<span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">Permite el desarrollo de c&aacute;tedras, lo cual refuerza los objetivos de los contenidos program&aacute;ticos impartidos en las aulas de clases, a trav&eacute;s del jard&iacute;n de plantas cultivadas.</span></p>\r\n\r\n<p><span class="html-tag" style="font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;"><strong><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">Objetivos Espec&iacute;ficos</span></strong></span></p>\r\n\r\n<p><span class="html-tag" style="font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;"><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">&bull; Elaborar un diagn&oacute;stico del &aacute;rea destinada para este proyecto en el Centro Jard&iacute;n Bot&aacute;nico.</span></span></p>\r\n\r\n<p><span class="html-tag" style="font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;"><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">&bull; Desarrollar cada uno de los rubros que ser&aacute;n parte productiva del Centro Jard&iacute;n Bot&aacute;nico.</span></span></p>\r\n\r\n<p><span class="html-tag" style="font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;"><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">&bull; Capacitar a los Consejos Comunales en materia de horticultura.</span></span></p>\r\n\r\n<p><span class="html-tag" style="font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;"><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">&bull; Destinar la producci&oacute;n a las comunidades aleda&ntilde;as y Universitaria.</span></span></p>\r\n\r\n<p><span class="html-tag" style="font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;"><span style="color: rgb(0, 0, 0); font-family: monospace; font-size: medium; line-height: normal; white-space: pre-wrap;">&bull; Dar cumplimiento al segundo objetivo del plan de la patria procurando la mayor suma de felicidad posible en materia donde se logre profundizar y ampliar las condiciones donde garantice la seguridad agroalimentaria</span></span></p>\r\n	Licdo. Alfredo Enrique Castillo Rojo		04124144244	aksas@kasas.com	1
\.


--
-- Name: centros_id_centro_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('centros_id_centro_seq', 11, true);


--
-- Data for Name: esp_inv; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY esp_inv (des_esp, id_esp) FROM stdin;
Base de Datos	1
Economia General	2
Ciencias Sociales	4
Psicolinguística	6
Educación	7
Metodologías de Investigación	8
Ciencias Educiativas	9
\.


--
-- Name: esp_inv_id_esp_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('esp_inv_id_esp_seq', 9, true);


--
-- Data for Name: evento_area; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY evento_area (des_area, id_area) FROM stdin;
Ciencias de la Salud	3
Ingeniería de Sistemas	2
\.


--
-- Name: evento_area_id_area_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('evento_area_id_area_seq', 3, true);


--
-- Data for Name: evento_espacio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY evento_espacio (des_espacio, id_espacio) FROM stdin;
Auditorio "Hugo Rafael Chávez Frías"	1
Salón de Usos Múltiples	2
\.


--
-- Name: evento_espacio_id_espacio_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('evento_espacio_id_espacio_seq', 2, true);


--
-- Data for Name: evento_info; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY evento_info (id, id_evento, fecha, hora) FROM stdin;
3697	298	2015-06-30	7
3698	298	2015-06-30	8
3699	298	2015-06-30	9
3700	298	2015-06-30	10
3701	298	2015-06-30	11
3702	298	2015-07-01	7
3703	298	2015-07-01	8
3704	298	2015-07-01	9
3705	298	2015-07-01	10
3706	298	2015-07-01	11
3707	299	2015-06-17	8
3708	299	2015-06-17	9
3709	299	2015-06-17	10
3710	299	2015-06-17	11
3711	299	2015-06-17	12
3712	299	2015-06-18	8
3713	299	2015-06-18	9
3714	299	2015-06-18	10
3715	299	2015-06-18	11
3716	299	2015-06-18	12
3717	300	2015-06-19	8
3718	300	2015-06-19	9
3719	300	2015-06-19	10
3720	300	2015-06-19	11
3721	300	2015-06-19	12
3722	300	2015-06-19	13
3723	300	2015-06-19	14
3724	300	2015-06-19	15
3725	300	2015-06-19	16
3726	301	2015-06-20	8
3727	301	2015-06-20	9
3728	301	2015-06-20	10
3729	301	2015-06-20	11
3730	301	2015-06-20	12
3731	301	2015-06-20	13
3732	301	2015-06-20	14
3775	303	2015-06-21	8
3776	303	2015-06-21	9
3777	303	2015-06-21	10
3778	303	2015-06-21	11
3779	303	2015-06-21	12
3780	303	2015-06-21	13
3781	303	2015-06-22	7
3782	303	2015-06-22	8
3783	303	2015-06-22	9
3784	303	2015-06-22	10
3785	303	2015-06-22	11
3786	303	2015-06-22	12
3787	303	2015-06-22	13
3788	303	2015-06-22	14
\.


--
-- Name: evento_info_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('evento_info_id_seq', 3804, true);


--
-- Data for Name: evento_publico; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY evento_publico (des_publico, id_publico) FROM stdin;
Público General	3
Estudiantes	4
\.


--
-- Name: evento_publico_id_publico_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('evento_publico_id_publico_seq', 4, true);


--
-- Data for Name: evento_tipo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY evento_tipo (des_tipo, id_tipo) FROM stdin;
Foro	2
Simposio	3
Mesa Redonda	4
Taller	5
\.


--
-- Name: evento_tipo_id_tipo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('evento_tipo_id_tipo_seq', 5, true);


--
-- Data for Name: eventos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY eventos (id_evento, nom_evento, obj_evento, pon_evento, inversion, est_evento, id_area, id_publico, id_tipo, id_espacio) FROM stdin;
299	Un Nuevo Evento	Objetivos	Ponentes	2000	A	2	3	4	1
300	Un Evento Importante	asa	sas	0	A	\N	3	5	1
301	Evento para el 20	aasaas	asas	0	A	2	3	4	1
298	Nueva Solicitud	ksjsas	asasas	200	R	2	4	3	1
303	Evento de Prueba	ssasas	asas	2000	A	\N	3	3	1
\.


--
-- Name: eventos_id_evento_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('eventos_id_evento_seq', 305, true);


--
-- Data for Name: info_decanato; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY info_decanato (id_decanato, mision, vision, fec_ult_act, email_dec) FROM stdin;
1	<p><img alt="" src="/investigacion/publico/admin/img/decanato_about.jpg" style="float: left; width: 400px; height: 203px;" /></p>\r\n\r\n<p>El Decanat<strong>o de Inv</strong>estigaci&oacute;n de la Universidad Nacional Experimental R&oacute;mulo Gallegos, tiene como misi&oacute;n la planificaci&oacute;n, coordinaci&oacute;n de las pol&iacute;ticas cient&iacute;ficas, human&iacute;sticas, sociales y tecnol&oacute;gicas, en permanente actualizaci&oacute;n y mejoramiento, que sustentan los programas acad&eacute;micos de la universidad, a trav&eacute;s del fomento, financiamiento y promoci&oacute;n de la investigaci&oacute;n, y los proyectos institucionales que se desprendan de la actividad de investigaci&oacute;n, extensi&oacute;n y comunitaria, as&iacute; como de la difusi&oacute;n del quehacer cient&iacute;fico, human&iacute;stico, social y tecnol&oacute;gico de la misma, tanto a nivel nacional como internacional, que brinde respuestas a las necesidades m&aacute;s sentidas de la sociedad, y ser un espacio de democracia participativa y protag&oacute;nica, desarrollar las capacidades de las comunidades, para la participaci&oacute;n y la comunicaci&oacute;n y contribuir activamente al empoderamiento de los sectores tradicionalmente relegados.</p>\r\n	<p>El Decanato de Investigaci&oacute;n y Extensi&oacute;n de la Universidad Nacional Experimental R&oacute;mulo Gallegos, es el &oacute;rgano universario gestor de excelencia en materia de planificaci&oacute;n y ejecuci&oacute;n que sustentan los programas de investigaci&oacute;n y extensi&oacute;n de nuestra instituci&oacute;n, con el prop&oacute;sito &nbsp;de fomentar la ciencia y la tecnolog&iacute;a al servicio del desarrollo nacional, regional y local, reducir las diferencias en el acceso al conocimiento, as&iacute; como de garantizar la participaci&oacute;n del personal acad&eacute;mico, obrero, administrativo y estudiantes, conjuntamente con la comunidad vecinal y socio productiva en la promoci&oacute;n y divulgaci&oacute;n de sus trabajos de investigaci&oacute;n, extensi&oacute;n, proyectos comunitarios y socio-productivos e incrementar los logros y productividad del sector cient&iacute;fico, social, humanistico y tecnologico, que transcienda al pais, apoyado en el marco legal, para as&iacute; consolidarnos como una instituci&oacute;n de prestigio nacional e internacional, altamente reconocida por su alto compromiso en la creaci&oacute;n, transformaci&oacute;n, generacion y socializacion &nbsp;de conocmientos de alta calidad etica, cientifica y tecnica, para contribuir activamente &nbsp;a pensar &nbsp;en el nuevo modelo productivo socialista.</p>\r\n	2015-06-16	deinvext@hotmail.com
\.


--
-- Name: info_decanato_id_decanato_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('info_decanato_id_decanato_seq', 2, true);


--
-- Data for Name: info_decanato_imagen; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY info_decanato_imagen (id_imagen, imagen, des_img, id_decanato) FROM stdin;
24	1-6-2015-0:18:8decanato2.png	Evento En El Decanato: Perspectivas\n\t\t\t\t	1
26	1-6-2015-0:19:1decanato_about.jpg	Decanato\n\t\t\t\t	1
28	16-6-2015-17:23:33decanato1.jpg	Postor\n\t\t\t\t	1
\.


--
-- Name: info_decanato_imagen_id_imagen_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('info_decanato_imagen_id_imagen_seq', 31, true);


--
-- Data for Name: info_decanato_jor; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY info_decanato_jor (id_jornada, pro_jor, norm_jor, mem_jor, fecha_jor, id_decanato, nom_jor) FROM stdin;
9	17-5-2015-16:10:4320990499.pdf	17-5-2015-16:10:4320990499 (2).pdf	17-5-2015-16:10:4320990499 (2).pdf	2014-03-01	1	Jornada 2014-I
10	17-5-2015-16:11:49Certificado (1).pdf	17-5-2015-16:11:4920990499 (1).pdf	17-5-2015-16:11:49reporteFinal.pdf	2015-01-01	1	Jornada 2015-II
\.


--
-- Name: info_decanato_jor_id_jornada_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('info_decanato_jor_id_jornada_seq', 11, true);


--
-- Data for Name: info_decanato_norma; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY info_decanato_norma (des_norma, id_norma, id_espacio) FROM stdin;
Esta es una norma	1	1
Para el salon	4	2
No Botar Basura	5	1
Dejar Todo en su lugar	6	1
Otra pes	7	2
\.


--
-- Name: info_decanato_norma_id_norma_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('info_decanato_norma_id_norma_seq', 7, true);


--
-- Data for Name: info_decanato_prog; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY info_decanato_prog (des_prog, mision_prog, vision_prog, id_decanato, id_prog) FROM stdin;
Programa de Extensión	Formar a través de la docencia, la investigación y la extensión, ciudadanos corresponsables con la seguridad y defensa integral de la nación, comprometidos con la Revolución Bolivariana, con competencias emancipadoras y humanistas necesarias para sustentar los planes de desarrollo del país, promoviendo la producción y el intercambio de saberes como mecanismo de integración latinoamericana y caribeña. \r\n\r\nFormar a través de la docencia, la investigación y la extensión, ciudadanos corresponsables con la seguridad y defensa integral de la nación, comprometidos con la Revolución Bolivariana, con competencias emancipadoras y humanistas necesarias para sustentar los planes de desarrollo del país, promoviendo la producción y el intercambio de saberes como mecanismo de integración latinoamericana y caribeña.	Ser la primera universidad socialista, reconocida por su excelencia educativa a nivel nacional e internacional, líder en los saberes humanistas, cientficos, tecnológicos y militares, inspirada en ideario bolivariano.\r\n\r\nSer la primera universidad socialista, reconocida por su excelencia educativa a nivel nacional e internacional, líder en los saberes humanistas, cientficos, tecnológicos y militares, inspirada en ideario bolivariano.	1	2
Programa de Investigación	Organismo rector de la función Investigación de la Universidad, encargado de planificar, coordinar y ejecutar las políticas de Investigación Científica, Humanística, Tecnológica y de las Artes, fundamentado en la interdisciplinariedad del saber, con pertinencia social y excelencia, en el marco de las necesidades de la sociedad a nivel Regional, Nacional e Internacional.\r\n\r\nOrganismo rector de la función Investigación de la Universidad, encargado de planificar, coordinar y ejecutar las políticas de Investigación Científica, Humanística, Tecnológica y de las Artes, fundamentado en la interdisciplinariedad 	Ser un organismo universitario gestor de la excelencia, que desarrollará las políticas de Investigación, garantizando la generación y difusión de conocimientos, propiciando la participación de todas las instancias académicas, en el marco de los lineamientos del Estado Venezolano, con el propósito de contribuir con el desarrollo Regional, Nacional e Internacional.\r\n\r\nSer un organismo universitario gestor de la excelencia, que desarrollará las políticas de Investigación, garantizando la generación y difusión de conocimientos, propiciando la participación de todas las instancias académicas, en el marco de los lineamientos del Estado Venezolano, con el propósito de contribuir con el desarrollo Regional, Nacional e Internacional.	1	1
\.


--
-- Name: info_decanato_prog_id_prog_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('info_decanato_prog_id_prog_seq', 2, true);


--
-- Data for Name: investigador_email; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY investigador_email (id_investigador, email_inv) FROM stdin;
34	jimenez@hotmail.com
35	rosalinda@kajsas.com
35	rosa@gmail.com
\.


--
-- Data for Name: investigador_esp; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY investigador_esp (id_investigador, id_esp) FROM stdin;
34	7
34	8
35	6
36	8
37	2
37	7
37	8
38	8
\.


--
-- Data for Name: investigador_tel; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY investigador_tel (id_investigador, tel_inv) FROM stdin;
34	04125552511
35	04124444556
35	12121212121
\.


--
-- Data for Name: investigadores; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY investigadores (id_investigador, nom_inv, ape_inv, des_inv, foto_inv, id_centro, id_prog) FROM stdin;
34	Juan Manuel	Jiménez	Ingeniero graduado en la UC. Magister en Ciencias Sociales	1-6-2015-8:57:24asa.jpg	8	1
35	Rosalinda	Pérez	Doctora en Psicolinguistica. UCV. Nivel III de Investigador en PEI	1-6-2015-9:0:32asasasas.jpg	11	1
36	Jose Rafael	Quintero Mendoza	Profesor Dedicación Exclusiva Facultad de Medicina	1-6-2015-9:1:39asasas.jpg	10	1
37	Rossana	Gonzalez	Doctora en Ciencias de Economía General	1-6-2015-9:3:2asas.jpg	9	1
38	Miguel	Bello	Extensionista	1-6-2015-9:4:11asasa.jpg	\N	2
\.


--
-- Name: investigadores_id_investigador_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('investigadores_id_investigador_seq', 40, true);


--
-- Data for Name: lineas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY lineas (id_linea, nom_lin, des_lin, id_centro, id_prog) FROM stdin;
19	Currículo y Evaluación.	se refiere al conjunto de objetivos, contenidos, criterios metodológicos y técnicas de evaluación que orientan la actividad académica (enseñanza y aprendizaje) ¿cómo enseñar?, ¿cuándo enseñar? y ¿qué, cómo y cuándo evaluar? El currículo permite planificar las actividades académicas de forma general, ya que lo específico viene determinado por los planes y programas de estudio (que no son lo mismo que el currículo). Mediante la construcción curricular la institución plasma su concepción de educación. De esta manera, el currículo permite la previsión de las cosas que se harán para poder lograr el modelo de individuo que se pretende generar a través de la implementación del mismo.	10	1
20	Ambiente y SocioProductividad	Aqui va la Descripción de la linea	8	1
21	Cultura, Paz, e Identidad Nacional	asasasas	11	1
22	Gerencia Educativa	Descripción de la línea	9	1
23	Linea de Extensión	Descripción	\N	2
\.


--
-- Name: lineas_id_linea_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('lineas_id_linea_seq', 26, true);


--
-- Data for Name: modulos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY modulos (cod_mod, des_mod) FROM stdin;
001	Gestión de Contenido General
003	Gestión de Revista NEXOS
002	Gestión de Espacios
\.


--
-- Data for Name: movimiento_usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov, id_movimiento_usu) FROM stdin;
042	34	2015-05-26	20:44:45.908527	190
043	34	2015-05-26	20:45:03.686225	191
056	34	2015-05-26	20:52:26.760001	192
039	34	2015-05-27	07:18:30.32589	193
041	34	2015-05-27	07:22:24.308943	194
039	34	2015-05-27	07:24:40.973248	195
040	34	2015-05-27	07:53:40.13592	196
039	34	2015-05-27	07:54:17.135441	197
041	34	2015-05-27	07:56:34.876227	198
039	34	2015-05-27	07:56:56.298046	199
040	34	2015-05-27	08:01:00.705159	200
040	34	2015-05-27	08:01:33.493868	201
039	34	2015-05-27	16:28:28.012286	202
039	34	2015-05-27	16:32:03.074878	203
039	34	2015-05-27	16:44:20.360201	204
021	34	2015-05-27	18:40:18.333172	205
024	34	2015-05-27	18:43:12.152059	206
011	34	2015-05-27	23:58:29.118613	207
013	34	2015-05-28	00:00:16.482563	208
039	34	2015-05-28	00:02:53.491293	209
043	34	2015-05-28	13:31:33.902013	210
043	34	2015-05-28	15:46:16.932719	211
028	34	2015-05-29	16:35:12.243235	212
028	34	2015-05-29	16:37:39.485348	213
028	34	2015-05-29	16:37:42.06311	214
028	34	2015-05-29	16:45:24.67477	215
026	34	2015-05-29	16:48:18.804881	216
027	65	2015-05-29	16:49:20.904227	217
040	34	2015-05-29	21:07:22.518573	218
041	34	2015-05-29	22:06:35.331688	219
041	34	2015-05-29	22:06:47.187452	220
041	34	2015-05-29	22:08:10.426835	221
041	34	2015-05-29	22:09:07.307114	222
041	34	2015-05-29	22:09:35.361764	223
041	34	2015-05-29	22:09:41.17271	224
041	34	2015-05-29	22:09:44.719771	225
039	34	2015-05-29	22:15:16.133638	226
041	34	2015-05-29	22:15:25.911354	227
041	34	2015-05-29	22:20:21.222437	228
039	34	2015-05-29	22:41:51.678954	229
039	34	2015-05-29	22:50:38.235028	230
040	34	2015-05-29	22:55:26.286194	231
010	34	2015-05-30	10:02:48.508739	232
001	34	2015-05-30	10:03:47.363569	233
043	34	2015-05-30	10:13:13.605764	234
042	34	2015-05-30	15:00:44.143542	235
039	34	2015-05-30	15:42:51.393669	236
043	34	2015-05-30	16:46:23.30548	237
043	34	2015-05-30	16:46:33.253558	238
043	34	2015-05-30	16:46:41.749752	239
043	34	2015-05-30	16:46:50.971875	240
042	34	2015-05-30	16:53:50.363853	241
023	34	2015-05-30	17:17:26.512159	242
020	34	2015-05-30	17:18:18.833721	243
041	34	2015-05-31	18:51:02.332395	244
040	34	2015-05-31	18:51:21.787918	245
040	34	2015-05-31	18:51:33.165454	246
039	34	2015-05-31	18:54:10.263621	247
040	34	2015-05-31	18:54:37.796117	248
041	34	2015-05-31	18:55:36.53994	249
039	34	2015-05-31	18:59:32.980512	250
040	34	2015-05-31	19:05:03.584893	251
040	34	2015-05-31	19:06:55.271195	252
041	34	2015-05-31	19:07:06.316259	253
042	34	2015-05-31	19:14:55.151753	254
040	34	2015-05-31	19:20:23.722603	255
039	34	2015-05-31	19:23:35.975883	256
004	34	2015-05-31	22:12:35.477962	257
004	34	2015-05-31	22:12:40.578103	258
004	34	2015-05-31	22:12:44.278047	259
001	34	2015-05-31	22:26:57.760113	260
001	34	2015-05-31	22:46:28.513338	261
010	34	2015-05-31	23:50:44.541517	262
010	34	2015-05-31	23:50:46.220255	263
010	34	2015-05-31	23:50:49.175615	264
013	34	2015-05-31	23:58:02.432264	265
013	34	2015-05-31	23:58:05.4659	266
013	34	2015-05-31	23:58:08.165762	267
016	34	2015-05-31	23:58:29.876601	268
022	34	2015-05-31	23:59:14.975852	269
022	34	2015-05-31	23:59:18.54285	270
025	34	2015-05-31	23:59:35.808605	271
025	34	2015-05-31	23:59:45.231315	272
025	34	2015-05-31	23:59:54.764577	273
025	34	2015-06-01	00:00:02.920091	274
025	34	2015-06-01	00:00:11.264047	275
025	34	2015-06-01	00:00:18.07445	276
025	34	2015-06-01	00:00:24.163715	277
025	34	2015-06-01	00:00:29.9187	278
025	34	2015-06-01	00:00:34.154715	279
025	34	2015-06-01	00:00:38.398479	280
025	34	2015-06-01	00:00:42.175606	281
025	34	2015-06-01	00:00:45.131687	282
025	34	2015-06-01	00:00:47.642697	283
019	34	2015-06-01	00:01:01.175708	284
019	34	2015-06-01	00:01:05.098591	285
019	34	2015-06-01	00:01:09.042186	286
019	34	2015-06-01	00:01:13.142166	287
019	34	2015-06-01	00:01:16.086565	288
019	34	2015-06-01	00:01:18.708742	289
016	34	2015-06-01	00:01:27.575096	290
016	34	2015-06-01	00:01:30.120159	291
016	34	2015-06-01	00:01:32.55292	292
035	34	2015-06-01	00:02:09.140497	293
035	34	2015-06-01	00:02:28.451236	294
035	34	2015-06-01	00:03:19.129935	295
009	34	2015-06-01	00:18:09.133905	296
009	34	2015-06-01	00:18:32.144711	297
009	34	2015-06-01	00:19:01.710796	298
010	34	2015-06-01	00:19:46.276502	299
009	34	2015-06-01	00:20:25.72048	300
011	34	2015-06-01	00:26:26.312896	301
011	34	2015-06-01	00:31:26.685192	302
013	34	2015-06-01	00:31:32.629238	303
011	34	2015-06-01	00:33:24.341172	304
012	34	2015-06-01	00:33:34.330358	305
013	34	2015-06-01	00:35:01.061964	306
011	34	2015-06-01	00:35:25.03901	307
011	34	2015-06-01	00:37:38.525112	308
011	34	2015-06-01	00:42:43.218944	309
013	34	2015-06-01	00:43:47.262795	310
011	34	2015-06-01	00:44:47.850523	311
011	34	2015-06-01	00:46:02.054613	312
011	34	2015-06-01	00:46:40.47056	313
011	34	2015-06-01	08:01:31.884076	314
013	34	2015-06-01	08:02:08.205649	315
013	34	2015-06-01	08:04:33.013283	316
013	34	2015-06-01	08:04:35.546971	317
013	34	2015-06-01	08:04:37.424631	318
011	34	2015-06-01	08:04:46.406428	319
013	34	2015-06-01	08:05:25.434647	320
011	34	2015-06-01	08:08:09.831247	321
012	34	2015-06-01	08:09:27.758371	322
012	34	2015-06-01	08:10:22.48466	323
011	34	2015-06-01	08:11:23.728756	324
011	34	2015-06-01	08:15:14.168404	325
014	34	2015-06-01	08:28:48.516847	326
015	34	2015-06-01	08:30:21.570476	327
014	34	2015-06-01	08:35:04.897929	328
015	34	2015-06-01	08:35:49.330252	329
014	34	2015-06-01	08:41:07.745377	330
015	34	2015-06-01	08:41:54.089783	331
014	34	2015-06-01	08:47:05.205806	332
015	34	2015-06-01	08:47:13.02833	333
017	34	2015-06-01	08:49:28.825556	334
017	34	2015-06-01	08:51:01.390701	335
017	34	2015-06-01	08:51:28.822858	336
017	34	2015-06-01	08:52:01.422816	337
017	34	2015-06-01	08:53:20.665516	338
023	34	2015-06-01	08:57:24.271626	339
023	34	2015-06-01	09:00:32.901523	340
023	34	2015-06-01	09:01:39.244801	341
023	34	2015-06-01	09:03:02.925126	342
023	34	2015-06-01	09:04:11.535081	343
020	34	2015-06-01	09:08:59.964959	344
020	34	2015-06-01	09:10:55.852281	345
020	34	2015-06-01	09:11:56.920765	346
020	34	2015-06-01	09:12:47.86443	347
020	34	2015-06-01	09:13:17.113507	348
039	34	2015-06-01	10:33:01.303384	349
039	34	2015-06-01	22:27:54.230236	350
039	34	2015-06-01	23:20:12.549123	351
039	34	2015-06-01	23:20:57.070661	352
039	34	2015-06-01	23:22:11.98036	353
028	34	2015-06-02	22:32:04.380687	354
002	34	2015-06-02	22:33:26.134876	355
002	34	2015-06-02	22:34:34.188959	356
010	34	2015-06-02	23:21:38.730386	357
002	34	2015-06-02	23:35:38.991925	358
017	34	2015-06-02	23:37:33.300887	359
023	34	2015-06-02	23:40:07.420435	360
023	34	2015-06-02	23:40:10.398812	361
025	34	2015-06-02	23:43:06.662554	362
025	34	2015-06-03	07:17:36.134524	363
028	34	2015-06-03	11:20:54.487463	364
002	34	2015-06-03	11:23:00.174119	365
042	34	2015-06-08	23:06:02.946667	366
020	34	2015-06-08	23:07:55.156556	367
022	34	2015-06-08	23:08:57.488668	368
019	34	2015-06-08	23:10:17.242313	369
004	34	2015-06-08	23:11:13.241526	370
028	34	2015-06-10	09:42:20.045987	371
042	34	2015-06-10	09:54:31.165458	372
041	34	2015-06-15	18:15:23.739565	373
041	34	2015-06-15	18:15:37.429115	374
041	34	2015-06-15	18:15:48.840254	375
041	34	2015-06-15	18:15:58.428691	376
041	34	2015-06-15	18:16:05.551072	377
041	34	2015-06-15	18:21:36.288798	378
041	34	2015-06-15	18:21:39.877599	379
039	34	2015-06-15	21:36:44.770698	380
039	34	2015-06-15	21:50:16.187611	381
041	34	2015-06-15	21:50:25.920491	382
039	34	2015-06-15	21:52:16.074099	383
040	34	2015-06-15	21:52:34.806685	384
041	34	2015-06-15	21:54:24.127006	385
015	34	2015-06-16	17:22:56.213202	386
009	34	2015-06-16	17:23:33.901436	387
028	34	2015-06-16	17:28:54.261894	388
028	34	2015-06-16	18:15:47.205668	389
028	34	2015-06-16	18:18:06.969546	390
028	34	2015-06-16	18:18:09.547488	391
001	34	2015-06-16	18:19:19.50493	392
002	34	2015-06-16	18:20:44.22319	393
009	34	2015-06-16	18:22:18.965664	394
010	34	2015-06-16	18:22:25.576988	395
017	34	2015-06-16	18:23:57.619739	396
039	34	2015-06-16	18:31:30.921856	397
039	34	2015-06-16	18:32:55.609487	398
039	34	2015-06-16	18:34:53.751957	399
043	34	2015-06-16	18:39:18.857224	400
026	34	2015-06-16	21:10:05.569762	401
027	34	2015-06-16	21:11:54.745279	402
028	34	2015-06-16	21:12:17.478166	403
028	34	2015-06-16	21:12:23.100302	404
029	34	2015-06-16	21:17:17.876127	405
002	34	2015-06-16	21:18:01.797	406
003	34	2015-06-16	21:19:08.548549	407
004	34	2015-06-16	21:19:26.873279	408
006	34	2015-06-16	21:22:01.658399	409
008	34	2015-06-16	21:25:42.989302	410
009	34	2015-06-16	21:26:46.788011	411
010	34	2015-06-16	21:27:04.043187	412
010	34	2015-06-16	21:27:12.532216	413
011	34	2015-06-16	21:28:13.521032	414
013	34	2015-06-16	21:28:53.775514	415
004	34	2015-06-16	22:09:55.889301	417
003	34	2015-06-16	22:10:31.743902	418
019	34	2015-06-16	22:10:56.40995	419
019	34	2015-06-16	22:11:15.843388	420
003	34	2015-06-16	22:54:22.080382	421
028	34	2015-06-16	23:11:39.157487	422
028	34	2015-06-16	23:12:09.857274	423
028	34	2015-06-16	23:21:51.869566	424
001	62	2015-06-16	23:24:07.128143	425
002	62	2015-06-16	23:26:13.974768	426
005	62	2015-06-16	23:26:48.224767	427
009	62	2015-06-16	23:27:51.817524	428
010	62	2015-06-16	23:27:57.250663	429
011	62	2015-06-16	23:29:25.615218	430
031	62	2015-06-16	23:34:01.398238	431
039	34	2015-06-16	23:40:17.079985	432
040	34	2015-06-16	23:41:48.522119	433
013	34	2015-06-20	18:45:41.279236	434
028	34	2015-06-17	10:41:16.33323	467
028	34	2015-06-17	10:41:24.133314	468
035	34	2015-06-17	10:43:39.262791	469
\.


--
-- Name: movimiento_usuario_id_movimiento_usu_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('movimiento_usuario_id_movimiento_usu_seq', 469, true);


--
-- Data for Name: movimientos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY movimientos (cod_mov, cod_mod, des_mov) FROM stdin;
001	001	Modificación de General (Misión, Visión, Email del Decanato)
002	001	Ingreso de Autoridad
003	001	Modificación de Autoridad
004	001	Eliminación de Autoridad
005	001	Edición de Programas
006	001	Ingreso de Jornada
007	001	Modificación de Jornada
008	001	Eliminación de Jornada
009	001	Ingreso de Imagen al Carousel
010	001	Eliminación de Imagen del Carousel
011	001	Ingreso de Noticia
012	001	Modificación de Noticia
013	001	Eliminación de Noticia
014	001	Ingreso de Centro
015	001	Modificación de Centro
016	001	Eliminación de Centro
017	001	Ingreso de Línea
018	001	Modificación de Línea
019	001	Eliminación de Línea
020	001	Ingreso de Proyecto
021	001	Modificación de Proyecto
022	001	Eliminación de Proyecto
023	001	Ingreso de Investigador/Extensionista
024	001	Modificación de Investigador/Extensionista
025	001	Eliminación de Investigador/Extensionista
026	001	Registro de Usuario
027	001	Modificación de Usuario
028	001	Cambio de Permiso a Usuario
029	001	Ingreso de Cargo para Autoridad
030	001	Modificación de Cargo para Autoridad
031	001	Eliminación de Cargo para Autoridad
032	001	Ingreso de Tipo de Proyecto
033	001	Modificación de Tipo de Proyecto
034	001	Eliminación de Tipo de Proyecto
035	001	Ingreso de Especialidad
036	001	Modificación de Especialidad
037	001	Eliminación de Especialidad
038	001	Cambio de Clave
039	002	Creación de Evento
040	002	Modificación de Evento
041	002	Eliminación de Evento
042	002	Aprobación de Evento
043	002	Rechazo de Evento
044	002	Creación de Norma
045	002	Modificación de Norma
046	002	Eliminación de Norma
047	002	Creación de Tipo de Público
048	002	Modificación de Tipo de Público
049	002	Eliminación de Tipo de Público
050	002	Creación de Tipo de Evento
051	002	Modificación de Tipo de Evento
052	002	Eliminación de Tipo de Evento
053	002	Creación de Área Académica
054	002	Modificación de Área Académica
055	002	Eliminación de Área Académica
056	002	Creación de Causa de No Aprobación
057	002	Modificación de Causa de No Aprobación
058	002	Eliminación de Causa de No Aprobación
\.


--
-- Data for Name: noaprob_causa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY noaprob_causa (des_causa, id_causa) FROM stdin;
El Evento no cumple con nuestras políticas	2
Se ha asignado otro evento para la fecha solicitada	3
Otra Causa	4
\.


--
-- Name: noaprob_causa_id_causa_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('noaprob_causa_id_causa_seq', 4, true);


--
-- Data for Name: noticia_img; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY noticia_img (id_noticia, img_not) FROM stdin;
48	1-6-2015-8:10:22images.jpg
49	1-6-2015-8:13:30Unerg.jpg
50	1-6-2015-8:15:13decanato_about.jpg
50	1-6-2015-8:15:13unerg-01.jpg
50	1-6-2015-8:15:14images (1).jpg
\.


--
-- Data for Name: noticias; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY noticias (id_noticia, titulo, des_not, fec_not, id_decanato) FROM stdin;
48	Notición	<p style="margin: 0.5em 0px; line-height: 22.3999996185303px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">En el a&ntilde;o&nbsp;<a href="http://es.wikipedia.org/wiki/1975" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="1975">1975</a>&nbsp;se crea la Comisi&oacute;n de Factibilidad para la creaci&oacute;n de una Universidad en el Estado&nbsp;<a href="http://es.wikipedia.org/wiki/Gu%C3%A1rico" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Guárico">Gu&aacute;rico</a>&nbsp;en&nbsp;<a href="http://es.wikipedia.org/wiki/Venezuela" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Venezuela">Venezuela</a>. En 1976 la Comisi&oacute;n solicita al Ejecutivo Regional la cesi&oacute;n de al menos mil hect&aacute;reas de terreno pertenecientes para construir la ciudad universitaria, &aacute;rea que se encuentra bajo el hermoso manto de Los Morros, hermoso monumento natural que domina los espacios universitarios.</p>\r\n\r\n<p style="margin: 0.5em 0px; line-height: 22.3999996185303px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">La&nbsp;<i>Universidad Nacional Experimental de los Llanos Centrales&nbsp;<a href="http://es.wikipedia.org/wiki/R%C3%B3mulo_Gallegos" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Rómulo Gallegos">R&oacute;mulo Gallegos</a></i>&nbsp;fue creada el&nbsp;<a href="http://es.wikipedia.org/wiki/25_de_julio" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="25 de julio">25 de julio</a>&nbsp;de&nbsp;<a href="http://es.wikipedia.org/wiki/1977" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="1977">1977</a>&nbsp;bajo Decreto Presidencial de la entonces llamada&nbsp;<a href="http://es.wikipedia.org/wiki/Venezuela" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Venezuela">Rep&uacute;blica de Venezuela</a>.</p>\r\n\r\n<p style="margin: 0.5em 0px; line-height: 22.3999996185303px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">Su Campus principal est&aacute; ubicada en&nbsp;<a class="mw-redirect" href="http://es.wikipedia.org/wiki/San_Juan_de_los_Morros" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="San Juan de los Morros">San Juan de los Morros</a>, estado&nbsp;<a href="http://es.wikipedia.org/wiki/Gu%C3%A1rico" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Guárico">Gu&aacute;rico</a>,&nbsp;<a href="http://es.wikipedia.org/wiki/Venezuela" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Venezuela">Venezuela</a>, donde se encuentran las &Aacute;reas de: Ciencias de la Salud, Agronom&iacute;a, Odontolog&iacute;a, Ciencias Econ&oacute;micas, Ingenier&iacute;a de Sistemas, y Ciencias Jur&iacute;dicas y Pol&iacute;ticas.</p>\r\n\r\n<p style="margin: 0.5em 0px; line-height: 22.3999996185303px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">La&nbsp;<a class="mw-redirect" href="http://es.wikipedia.org/wiki/UNERG" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="UNERG">UNERG</a>&nbsp;Tambi&eacute;n posee campus en otras ciudades del Estado&nbsp;<a href="http://es.wikipedia.org/wiki/Gu%C3%A1rico" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Guárico">Gu&aacute;rico</a>:</p>\r\n\r\n<p style="margin: 0.5em 0px; line-height: 22.3999996185303px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">- En la&nbsp;<a href="http://es.wikipedia.org/wiki/Calabozo_(Venezuela)" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Calabozo (Venezuela)">Ciudad de Calabozo</a>&nbsp;se encuentra la Facultad de Ciencias de la Educaci&oacute;n, espec&iacute;ficamente&nbsp;<a href="http://es.wikipedia.org/wiki/Licenciatura" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Licenciatura">Licenciatura</a>&nbsp;en&nbsp;<a href="http://es.wikipedia.org/wiki/Educaci%C3%B3n" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Educación">Educaci&oacute;n</a>Menci&oacute;n:&nbsp;<a class="mw-redirect" href="http://es.wikipedia.org/wiki/Computaci%C3%B3n" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Computación">Computaci&oacute;n</a>&nbsp;y&nbsp;<a href="http://es.wikipedia.org/wiki/Educaci%C3%B3n" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Educación">Educaci&oacute;n</a>&nbsp;Integral. A partir del 2007 se inicia la Escuela de Medicina. A partir del 2010 inician las carrera Licenciatura en&nbsp;<a href="http://es.wikipedia.org/wiki/Historia" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Historia">Historia</a>&nbsp;e Ingenier&iacute;a Civil</p>\r\n	2015-06-01	1
49	Estudian ampliar oferta académica en la Unerg	<p style="margin: 0.5em 0px; line-height: 22.3999996185303px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">- En la Ciudad de&nbsp;<a href="http://es.wikipedia.org/wiki/Zaraza" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Zaraza">Zaraza</a>&nbsp;se encuentra la Facultad de Ciencias Veterinarias, N&uacute;cleo de la Principal Escuela de Medicina Veterinaria en el pa&iacute;s.</p>\r\n\r\n<p style="margin: 0.5em 0px; line-height: 22.3999996185303px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">- En la Ciudad de&nbsp;<a href="http://es.wikipedia.org/wiki/Valle_de_la_Pascua" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Valle de la Pascua">Valle de la Pascua</a>&nbsp;se desarrollan actividades de Postgrado,Medicina y Econom&iacute;a pr&oacute;ximamente Contadur&iacute;a P&uacute;blica y Ingenier&iacute;a Civil.</p>\r\n\r\n<p style="margin: 0.5em 0px; line-height: 22.3999996185303px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">- Y finalmente en Altagracia de Orituco se desarrollan actividades de Postgrado.</p>\r\n\r\n<p style="margin: 0.5em 0px; line-height: 22.3999996185303px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">El 21 de enero de 1980 se inician las actividades acad&eacute;micas con las carreras de Ingenier&iacute;a Agron&oacute;mica de Producci&oacute;n Animal e Ingenier&iacute;a Agron&oacute;mica de Producci&oacute;n Vegetal.</p>\r\n\r\n<p style="margin: 0.5em 0px; line-height: 22.3999996185303px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">La carrera de Enfermer&iacute;a, en su modalidad de TSU, fue la segunda carrera en iniciar sus actividades.</p>\r\n\r\n<p style="margin: 0.5em 0px; line-height: 22.3999996185303px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">En 1990 se aprueba la carrera de Medicina Veterinaria. En diciembre de 1992 se inician las actividades acad&eacute;micas de la carrera de Odontolog&iacute;a. En 1993 se inician las actividades acad&eacute;micas de Medicina. En 1993 se inician las actividades acad&eacute;micas de Ciencias de la Educaci&oacute;n. En 1994 se inician las actividades acad&eacute;micas de Ciencias Econ&oacute;micas y Sociales. En 2002 se inician las actividades acad&eacute;micas de Ingenier&iacute;a de Sistemas. En 2005 se inician las actividades acad&eacute;micas de Ciencias Jur&iacute;dicas.y Pol&iacute;ticas.</p>\r\n	2015-06-01	1
50	La Unerg convoca a inscripciones para sus cursos de historia	<ul style="margin: 0.3em 0px 0px 1.6em; padding-right: 0px; padding-left: 0px; list-style-image: url(data:image/svg+xml,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22UTF-8%22%3F%3E%0A%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20version%3D%221.1%22%20width%3D%225%22%20height%3D%2213%22%3E%0A%3Ccircle%20cx%3D%222.5%22%20cy%3D%229.5%22%20r%3D%222.5%22%20fill%3D%22%2300528c%22%2F%3E%0A%3C%2Fsvg%3E%0A); color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px; line-height: 22.3999996185303px;">\r\n\t<li style="margin-bottom: 0.1em;">Ingenier&iacute;a en Inform&aacute;tica</li>\r\n</ul>\r\n\r\n<p style="margin: 0.5em 0px; line-height: 22.3999996185303px; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">Actualmente el &Aacute;rea de Ingenier&iacute;a de Sistemas, crece en cuanto a estructura y edificaciones (aparte de la ya existente). Gracias a la gesti&oacute;n de la actual rector&iacute;a de la UNERG, se encuentra en construcci&oacute;n 2 nuevas edificaciones en la facultad, una destinada a la ampliaci&oacute;n de las aulas de clases (Edificio de Aulas), que permitir&aacute; la ampliaci&oacute;n del &aacute;rea en cuanto a capacidad y comodidad estudiantil. Y la segunda edificaci&oacute;n servir&aacute; de comedor-biblioteca (Comedor/Biblioteca), esto permitir&aacute; que los estudiantes de la facultad ya no tengan que trasladarse a la biblioteca ni al comedor central, puesto que gozar&aacute;n de estos beneficios en las mismas &aacute;reas. Actualmente dichas obras no est&aacute;n construidas en su totalidad, la destinada a ampliaci&oacute;n de las aulas se ha visto abandonada y sin cuidar, y la otra obra (comedor-biblioteca) solo se ven los cimientos donde alg&uacute;n dia probablemente lejano, est&eacute; establecido el mismo. &quot;Tambi&eacute;n podr&aacute;n disfrutar de &aacute;reas verdes y de esparcimiento&quot;.</p>\r\n	2015-06-01	1
\.


--
-- Name: noticias_id_noticia_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('noticias_id_noticia_seq', 52, true);


--
-- Data for Name: permisos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY permisos (id_usuario, cod_mod) FROM stdin;
34	002
34	001
63	002
64	001
65	001
62	001
66	002
66	001
\.


--
-- Data for Name: proyecto_inv; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY proyecto_inv (id_proyecto, id_investigador) FROM stdin;
22	35
23	36
24	37
25	34
26	38
\.


--
-- Data for Name: proyecto_tipo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY proyecto_tipo (des_tipo_pro, id_tipo_pro) FROM stdin;
Proyecto Colectivo	2
Proyecto Individual	1
\.


--
-- Name: proyecto_tipo_id_tipo_pro_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('proyecto_tipo_id_tipo_pro_seq', 5, true);


--
-- Data for Name: proyectos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY proyectos (id_proyecto, tit_pro, obj_pro, fec_ini_pro, fec_cul_pro, id_linea, id_centro, id_tipo_pro, id_prog) FROM stdin;
22	Programa Municipal para el Desarrollo del Aprendizaje y la Convivencia Ciudadana. una Política Pública de Educación Dirigida a los Estudiantes en Riesgo a Fracaso Escolar y en Riesgo a Delinquir. Municipio Autónomo Francisco de Miranda del Estado Guárico.	La creacion de un programa municipal	2012-06-01	2015-06-01	21	11	1	1
23	Aprendizaje Estratégico de la Investigación Educativa. Una Mirada Transcompleja desde los Actores Sociales de la EducaciónUniversitaria	Objetivos	2013-06-01	2016-06-01	19	10	1	1
24	La investigación  acción y su reciprocidad con los proyectos de aprendizaje.	Tales Objetivos	2009-06-01	2011-06-01	22	9	1	1
25	Saberes y haceres universitarios desde una perspectiva heurística del talento humano.	objetivos	2015-06-01	2017-06-01	20	8	1	1
26	Proyecto de Extensión	Objetivos	2015-06-01	2016-06-01	23	\N	1	2
\.


--
-- Name: proyectos_id_proyecto_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('proyectos_id_proyecto_seq', 27, true);


--
-- Data for Name: solic_esp; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY solic_esp (cod_sol, nom_solicitante, ape_solicitante, ced_solicitante, tel_solicitante, est_sol, fec_sol, id_evento, id_causa, interes) FROM stdin;
AUD-5556374341	Juan	Nis	18271872	87212121212	R	2015-06-15	298	2	t
\.


--
-- Data for Name: usuario_email; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY usuario_email (id_usuario, email_usu) FROM stdin;
34	jhonny.cordova@hotmail.com
34	cordova.jhonny@gmail.com
65	ssasasa@kahsjas.com
64	asas@jahsas.com
62	yoli@hotmail.com
62	jasjas@jasas.com
63	sasas@jaksa.com
\.


--
-- Data for Name: usuario_tel; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY usuario_tel (id_usuario, tel_usu) FROM stdin;
62	04124444441
62	04144463689
63	04124242442
34	04144463689
\.


--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY usuarios (id_usuario, usuario, clave, nom_usu, ape_usu, estado) FROM stdin;
62	yoli	d2b77b19caa93b92506aecc04a8c09b0	Yoli	Cordova	A
63	yeli	e10adc3949ba59abbe56e057f20f883e	Yelixa	Flores	A
34	jhonnycordova	d2b77b19caa93b92506aecc04a8c09b0	Jhonny Rafael	Córdova Flores	A
65	yovanny	d2b77b19caa93b92506aecc04a8c09b0	Yovanny	Cordova	A
64	fulana	e10adc3949ba59abbe56e057f20f883e	Fulana	Fulana	A
66	leonel	8b254ccb7217f2e3bd08186521fc38d5	Leonel	Rojas	I
\.


--
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('usuarios_id_usuario_seq', 66, true);


--
-- Name: pkarea; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY evento_area
    ADD CONSTRAINT pkarea PRIMARY KEY (id_area);


--
-- Name: pkautoridad; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY autoridades
    ADD CONSTRAINT pkautoridad PRIMARY KEY (id_autoridad);


--
-- Name: pkautoridad_email; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY autoridad_email
    ADD CONSTRAINT pkautoridad_email PRIMARY KEY (id_autoridad, email_aut);


--
-- Name: pkautoridad_tel; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY autoridad_tel
    ADD CONSTRAINT pkautoridad_tel PRIMARY KEY (id_autoridad, tel_aut);


--
-- Name: pkcargos; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY autoridad_cargo
    ADD CONSTRAINT pkcargos PRIMARY KEY (id_cargo);


--
-- Name: pkcausa; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY noaprob_causa
    ADD CONSTRAINT pkcausa PRIMARY KEY (id_causa);


--
-- Name: pkcentro; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY centros
    ADD CONSTRAINT pkcentro PRIMARY KEY (id_centro);


--
-- Name: pkdecanato; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY info_decanato
    ADD CONSTRAINT pkdecanato PRIMARY KEY (id_decanato);


--
-- Name: pkespacio; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY evento_espacio
    ADD CONSTRAINT pkespacio PRIMARY KEY (id_espacio);


--
-- Name: pkespecia; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY esp_inv
    ADD CONSTRAINT pkespecia PRIMARY KEY (id_esp);


--
-- Name: pkespecialidades; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY investigador_esp
    ADD CONSTRAINT pkespecialidades PRIMARY KEY (id_investigador, id_esp);


--
-- Name: pkevento; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY eventos
    ADD CONSTRAINT pkevento PRIMARY KEY (id_evento);


--
-- Name: pkevento_info; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY evento_info
    ADD CONSTRAINT pkevento_info PRIMARY KEY (id);


--
-- Name: pkimagen; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY info_decanato_imagen
    ADD CONSTRAINT pkimagen PRIMARY KEY (id_imagen);


--
-- Name: pkinfo_jor; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY info_decanato_jor
    ADD CONSTRAINT pkinfo_jor PRIMARY KEY (id_jornada);


--
-- Name: pkinvestigador_email; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY investigador_email
    ADD CONSTRAINT pkinvestigador_email PRIMARY KEY (id_investigador, email_inv);


--
-- Name: pkinvestigador_tel; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY investigador_tel
    ADD CONSTRAINT pkinvestigador_tel PRIMARY KEY (id_investigador, tel_inv);


--
-- Name: pkinvestigadores; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY investigadores
    ADD CONSTRAINT pkinvestigadores PRIMARY KEY (id_investigador);


--
-- Name: pklineas; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY lineas
    ADD CONSTRAINT pklineas PRIMARY KEY (id_linea);


--
-- Name: pkmodulo; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY modulos
    ADD CONSTRAINT pkmodulo PRIMARY KEY (cod_mod);


--
-- Name: pkmovimien; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY movimientos
    ADD CONSTRAINT pkmovimien PRIMARY KEY (cod_mov);


--
-- Name: pkmovimiento_usuario; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY movimiento_usuario
    ADD CONSTRAINT pkmovimiento_usuario PRIMARY KEY (id_movimiento_usu);


--
-- Name: pknorma; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY info_decanato_norma
    ADD CONSTRAINT pknorma PRIMARY KEY (id_norma);


--
-- Name: pknoticia_img; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY noticia_img
    ADD CONSTRAINT pknoticia_img PRIMARY KEY (id_noticia, img_not);


--
-- Name: pknoticias; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY noticias
    ADD CONSTRAINT pknoticias PRIMARY KEY (id_noticia);


--
-- Name: pkpermisos; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY permisos
    ADD CONSTRAINT pkpermisos PRIMARY KEY (id_usuario, cod_mod);


--
-- Name: pkprog; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY info_decanato_prog
    ADD CONSTRAINT pkprog PRIMARY KEY (id_prog);


--
-- Name: pkproyecto_inv; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY proyecto_inv
    ADD CONSTRAINT pkproyecto_inv PRIMARY KEY (id_proyecto, id_investigador);


--
-- Name: pkproyectos; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY proyectos
    ADD CONSTRAINT pkproyectos PRIMARY KEY (id_proyecto);


--
-- Name: pkpublico; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY evento_publico
    ADD CONSTRAINT pkpublico PRIMARY KEY (id_publico);


--
-- Name: pksolic_aud; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY solic_esp
    ADD CONSTRAINT pksolic_aud PRIMARY KEY (cod_sol);


--
-- Name: pktipo; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY evento_tipo
    ADD CONSTRAINT pktipo PRIMARY KEY (id_tipo);


--
-- Name: pktipopro; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY proyecto_tipo
    ADD CONSTRAINT pktipopro PRIMARY KEY (id_tipo_pro);


--
-- Name: pkusuario_tel; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usuario_tel
    ADD CONSTRAINT pkusuario_tel PRIMARY KEY (id_usuario, tel_usu);


--
-- Name: pkusuarios; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usuarios
    ADD CONSTRAINT pkusuarios PRIMARY KEY (id_usuario);


--
-- Name: pkusuarios_email; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usuario_email
    ADD CONSTRAINT pkusuarios_email PRIMARY KEY (id_usuario, email_usu);


--
-- Name: unique_usuario; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usuarios
    ADD CONSTRAINT unique_usuario UNIQUE (usuario);


--
-- Name: fki_fkarea; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkarea ON eventos USING btree (id_area);


--
-- Name: fki_fkaut_dec; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkaut_dec ON autoridades USING btree (id_decanato);


--
-- Name: fki_fkautoridad; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkautoridad ON autoridad_tel USING btree (id_autoridad);


--
-- Name: fki_fkautoridad_email; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkautoridad_email ON autoridad_email USING btree (id_autoridad);


--
-- Name: fki_fkcargoss; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkcargoss ON autoridades USING btree (id_cargo);


--
-- Name: fki_fkcausaa; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkcausaa ON solic_esp USING btree (id_causa);


--
-- Name: fki_fkcen_dec; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkcen_dec ON centros USING btree (id_decanato);


--
-- Name: fki_fkcodmov; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkcodmov ON movimiento_usuario USING btree (cod_mov);


--
-- Name: fki_fkdec_mg; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkdec_mg ON info_decanato_imagen USING btree (id_decanato);


--
-- Name: fki_fkespac; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkespac ON info_decanato_norma USING btree (id_espacio);


--
-- Name: fki_fkespacio; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkespacio ON eventos USING btree (id_espacio);


--
-- Name: fki_fkespc; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkespc ON investigador_esp USING btree (id_esp);


--
-- Name: fki_fkevento_evento; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkevento_evento ON evento_info USING btree (id_evento);


--
-- Name: fki_fkinfo_jor; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkinfo_jor ON info_decanato_jor USING btree (id_decanato);


--
-- Name: fki_fkinfo_prog; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkinfo_prog ON info_decanato_prog USING btree (id_decanato);


--
-- Name: fki_fkinv_cent; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkinv_cent ON investigadores USING btree (id_centro);


--
-- Name: fki_fkinvestigador_email; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkinvestigador_email ON investigador_email USING btree (id_investigador);


--
-- Name: fki_fkinvestigador_inv; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkinvestigador_inv ON investigador_esp USING btree (id_investigador);


--
-- Name: fki_fkinvestigador_tel; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkinvestigador_tel ON investigador_tel USING btree (id_investigador);


--
-- Name: fki_fklinea_centro; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fklinea_centro ON lineas USING btree (id_centro);


--
-- Name: fki_fkmov_usu; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkmov_usu ON movimiento_usuario USING btree (id_usuario);


--
-- Name: fki_fkmovimiento_mod; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkmovimiento_mod ON movimientos USING btree (cod_mod);


--
-- Name: fki_fkmovimiento_mod1; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkmovimiento_mod1 ON movimientos USING btree (cod_mod);


--
-- Name: fki_fknoticia; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fknoticia ON noticia_img USING btree (id_noticia);


--
-- Name: fki_fkpermiso_usu; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkpermiso_usu ON permisos USING btree (id_usuario);


--
-- Name: fki_fkpermisos_mod; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkpermisos_mod ON permisos USING btree (cod_mod);


--
-- Name: fki_fkprog_lin; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkprog_lin ON lineas USING btree (id_prog);


--
-- Name: fki_fkprogramas; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkprogramas ON investigadores USING btree (id_prog);


--
-- Name: fki_fkprogramas_pro; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkprogramas_pro ON proyectos USING btree (id_prog);


--
-- Name: fki_fkproyecto_centro; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkproyecto_centro ON proyectos USING btree (id_centro);


--
-- Name: fki_fkproyecto_inv; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkproyecto_inv ON proyecto_inv USING btree (id_proyecto);


--
-- Name: fki_fkproyecto_linea; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkproyecto_linea ON proyectos USING btree (id_linea);


--
-- Name: fki_fkproyectos_investigadores; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkproyectos_investigadores ON proyecto_inv USING btree (id_investigador);


--
-- Name: fki_fkpublico; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fkpublico ON eventos USING btree (id_publico);


--
-- Name: fki_fksolic_evento; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fksolic_evento ON solic_esp USING btree (id_evento);


--
-- Name: fki_fktipoevent; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fktipoevent ON eventos USING btree (id_tipo);


--
-- Name: fki_fktipoproyecto; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fktipoproyecto ON proyectos USING btree (id_tipo_pro);


--
-- Name: fki_fnot_dec; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_fnot_dec ON noticias USING btree (id_decanato);


--
-- Name: fkarea; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY eventos
    ADD CONSTRAINT fkarea FOREIGN KEY (id_area) REFERENCES evento_area(id_area);


--
-- Name: fkaut_dec; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY autoridades
    ADD CONSTRAINT fkaut_dec FOREIGN KEY (id_decanato) REFERENCES info_decanato(id_decanato);


--
-- Name: fkautoridad; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY autoridad_tel
    ADD CONSTRAINT fkautoridad FOREIGN KEY (id_autoridad) REFERENCES autoridades(id_autoridad);


--
-- Name: fkautoridad_email; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY autoridad_email
    ADD CONSTRAINT fkautoridad_email FOREIGN KEY (id_autoridad) REFERENCES autoridades(id_autoridad);


--
-- Name: fkcargoss; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY autoridades
    ADD CONSTRAINT fkcargoss FOREIGN KEY (id_cargo) REFERENCES autoridad_cargo(id_cargo);


--
-- Name: fkcausaa; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY solic_esp
    ADD CONSTRAINT fkcausaa FOREIGN KEY (id_causa) REFERENCES noaprob_causa(id_causa);


--
-- Name: fkcen_dec; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY centros
    ADD CONSTRAINT fkcen_dec FOREIGN KEY (id_decanato) REFERENCES info_decanato(id_decanato);


--
-- Name: fkcodmov; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY movimiento_usuario
    ADD CONSTRAINT fkcodmov FOREIGN KEY (cod_mov) REFERENCES movimientos(cod_mov);


--
-- Name: fkdec_mg; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY info_decanato_imagen
    ADD CONSTRAINT fkdec_mg FOREIGN KEY (id_decanato) REFERENCES info_decanato(id_decanato);


--
-- Name: fkespac; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY info_decanato_norma
    ADD CONSTRAINT fkespac FOREIGN KEY (id_espacio) REFERENCES evento_espacio(id_espacio);


--
-- Name: fkespacio; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY eventos
    ADD CONSTRAINT fkespacio FOREIGN KEY (id_espacio) REFERENCES evento_espacio(id_espacio);


--
-- Name: fkespc; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY investigador_esp
    ADD CONSTRAINT fkespc FOREIGN KEY (id_esp) REFERENCES esp_inv(id_esp);


--
-- Name: fkevento_evento; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evento_info
    ADD CONSTRAINT fkevento_evento FOREIGN KEY (id_evento) REFERENCES eventos(id_evento);


--
-- Name: fkinfo_jor; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY info_decanato_jor
    ADD CONSTRAINT fkinfo_jor FOREIGN KEY (id_decanato) REFERENCES info_decanato(id_decanato);


--
-- Name: fkinfo_prog; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY info_decanato_prog
    ADD CONSTRAINT fkinfo_prog FOREIGN KEY (id_decanato) REFERENCES info_decanato(id_decanato);


--
-- Name: fkinv_cent; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY investigadores
    ADD CONSTRAINT fkinv_cent FOREIGN KEY (id_centro) REFERENCES centros(id_centro);


--
-- Name: fkinvestigador_email; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY investigador_email
    ADD CONSTRAINT fkinvestigador_email FOREIGN KEY (id_investigador) REFERENCES investigadores(id_investigador);


--
-- Name: fkinvestigador_inv; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY investigador_esp
    ADD CONSTRAINT fkinvestigador_inv FOREIGN KEY (id_investigador) REFERENCES investigadores(id_investigador);


--
-- Name: fkinvestigador_tel; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY investigador_tel
    ADD CONSTRAINT fkinvestigador_tel FOREIGN KEY (id_investigador) REFERENCES investigadores(id_investigador);


--
-- Name: fklinea_centro; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY lineas
    ADD CONSTRAINT fklinea_centro FOREIGN KEY (id_centro) REFERENCES centros(id_centro);


--
-- Name: fkmov_usu; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY movimiento_usuario
    ADD CONSTRAINT fkmov_usu FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario);


--
-- Name: fkmovimiento_mod1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY movimientos
    ADD CONSTRAINT fkmovimiento_mod1 FOREIGN KEY (cod_mod) REFERENCES modulos(cod_mod);


--
-- Name: fknoticia; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY noticia_img
    ADD CONSTRAINT fknoticia FOREIGN KEY (id_noticia) REFERENCES noticias(id_noticia);


--
-- Name: fkpermiso_usu; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY permisos
    ADD CONSTRAINT fkpermiso_usu FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario);


--
-- Name: fkpermisos_mod; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY permisos
    ADD CONSTRAINT fkpermisos_mod FOREIGN KEY (cod_mod) REFERENCES modulos(cod_mod);


--
-- Name: fkprog_lin; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY lineas
    ADD CONSTRAINT fkprog_lin FOREIGN KEY (id_prog) REFERENCES info_decanato_prog(id_prog);


--
-- Name: fkprogramas; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY investigadores
    ADD CONSTRAINT fkprogramas FOREIGN KEY (id_prog) REFERENCES info_decanato_prog(id_prog);


--
-- Name: fkprogramas_pro; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyectos
    ADD CONSTRAINT fkprogramas_pro FOREIGN KEY (id_prog) REFERENCES info_decanato_prog(id_prog);


--
-- Name: fkproyecto_centro; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyectos
    ADD CONSTRAINT fkproyecto_centro FOREIGN KEY (id_centro) REFERENCES centros(id_centro);


--
-- Name: fkproyecto_inv; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyecto_inv
    ADD CONSTRAINT fkproyecto_inv FOREIGN KEY (id_proyecto) REFERENCES proyectos(id_proyecto);


--
-- Name: fkproyecto_linea; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyectos
    ADD CONSTRAINT fkproyecto_linea FOREIGN KEY (id_linea) REFERENCES lineas(id_linea);


--
-- Name: fkproyectos_investigadores; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyecto_inv
    ADD CONSTRAINT fkproyectos_investigadores FOREIGN KEY (id_investigador) REFERENCES investigadores(id_investigador);


--
-- Name: fkpublico; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY eventos
    ADD CONSTRAINT fkpublico FOREIGN KEY (id_publico) REFERENCES evento_publico(id_publico);


--
-- Name: fksolic_evento; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY solic_esp
    ADD CONSTRAINT fksolic_evento FOREIGN KEY (id_evento) REFERENCES eventos(id_evento);


--
-- Name: fktipoevent; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY eventos
    ADD CONSTRAINT fktipoevent FOREIGN KEY (id_tipo) REFERENCES evento_tipo(id_tipo);


--
-- Name: fktipoproyecto; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyectos
    ADD CONSTRAINT fktipoproyecto FOREIGN KEY (id_tipo_pro) REFERENCES proyecto_tipo(id_tipo_pro);


--
-- Name: fkusuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario_tel
    ADD CONSTRAINT fkusuario FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario);


--
-- Name: fkusuarios; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario_email
    ADD CONSTRAINT fkusuarios FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario);


--
-- Name: fnot_dec; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY noticias
    ADD CONSTRAINT fnot_dec FOREIGN KEY (id_decanato) REFERENCES info_decanato(id_decanato);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

