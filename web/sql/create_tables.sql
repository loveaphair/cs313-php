--
-- PostgreSQL database dump
--

-- Dumped from database version 10.6
-- Dumped by pg_dump version 10.6

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: users_id_sq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_sq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_sq OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: clients; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.clients (
    id integer DEFAULT nextval('public.users_id_sq'::regclass) NOT NULL,
    clientpassword character varying(255) NOT NULL,
    client_hash character varying(255) NOT NULL,
    clientemail character varying(50) NOT NULL,
    clientfirstname character varying(50) NOT NULL,
    clientlastname character varying(50) NOT NULL,
    created_at timestamp with time zone NOT NULL,
    clientlevel integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.clients OWNER TO postgres;

--
-- Name: ingredient_types; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ingredient_types (
    id integer NOT NULL,
    name character varying(50) NOT NULL
);


ALTER TABLE public.ingredient_types OWNER TO postgres;

--
-- Name: ingredients_id_sequence; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ingredients_id_sequence
    START WITH 10
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ingredients_id_sequence OWNER TO postgres;

--
-- Name: ingredients; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ingredients (
    id integer DEFAULT nextval('public.ingredients_id_sequence'::regclass) NOT NULL,
    title character varying(50) NOT NULL,
    ingredient_type_id integer NOT NULL
);


ALTER TABLE public.ingredients OWNER TO postgres;

--
-- Name: measurements; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.measurements (
    id integer NOT NULL,
    name character varying NOT NULL
);


ALTER TABLE public.measurements OWNER TO postgres;

--
-- Name: recipe_categories; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.recipe_categories (
    id integer NOT NULL,
    name character varying(50) NOT NULL
);


ALTER TABLE public.recipe_categories OWNER TO postgres;

--
-- Name: recipe_ingredients_id_s; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.recipe_ingredients_id_s
    START WITH 12
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.recipe_ingredients_id_s OWNER TO postgres;

--
-- Name: recipe_ingredients; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.recipe_ingredients (
    id integer DEFAULT nextval('public.recipe_ingredients_id_s'::regclass) NOT NULL,
    recipes_id integer NOT NULL,
    measurement_id integer,
    ingredient_id integer NOT NULL,
    created_ts timestamp with time zone NOT NULL,
    created_user_id integer NOT NULL,
    measurement_amt character(11) NOT NULL
);


ALTER TABLE public.recipe_ingredients OWNER TO postgres;

--
-- Name: recipe_instructions_id_s; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.recipe_instructions_id_s
    START WITH 2
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.recipe_instructions_id_s OWNER TO postgres;

--
-- Name: recipe_instructions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.recipe_instructions (
    id integer DEFAULT nextval('public.recipe_instructions_id_s'::regclass) NOT NULL,
    recipes_id integer NOT NULL,
    instructions text NOT NULL,
    created_ts timestamp with time zone NOT NULL,
    created_user_id integer NOT NULL
);


ALTER TABLE public.recipe_instructions OWNER TO postgres;

--
-- Name: recipes_id_s; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.recipes_id_s
    START WITH 2
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.recipes_id_s OWNER TO postgres;

--
-- Name: recipes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.recipes (
    id integer DEFAULT nextval('public.recipes_id_s'::regclass) NOT NULL,
    title character varying(50) NOT NULL,
    recipe_category_id integer NOT NULL,
    created_ts timestamp with time zone NOT NULL,
    created_user_id integer NOT NULL,
    image_file character varying(50)
);


ALTER TABLE public.recipes OWNER TO postgres;

--
-- Name: registration; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.registration (
    id integer NOT NULL,
    reg_pass character varying NOT NULL
);


ALTER TABLE public.registration OWNER TO postgres;

--
-- Name: scripture_topic_id_sq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.scripture_topic_id_sq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.scripture_topic_id_sq OWNER TO postgres;

--
-- Name: scriptures; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.scriptures (
    id integer NOT NULL,
    book character varying(30) NOT NULL,
    chapter integer NOT NULL,
    verse integer NOT NULL,
    content text NOT NULL
);


ALTER TABLE public.scriptures OWNER TO postgres;

--
-- Name: scriptures_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.scriptures_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.scriptures_id_seq OWNER TO postgres;

--
-- Name: scriptures_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.scriptures_id_seq OWNED BY public.scriptures.id;


--
-- Name: scripture_topic_links; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.scripture_topic_links (
    id integer DEFAULT nextval('public.scriptures_id_seq'::regclass) NOT NULL,
    scriptures_id integer NOT NULL,
    topic_id integer NOT NULL
);


ALTER TABLE public.scripture_topic_links OWNER TO postgres;

--
-- Name: TABLE scripture_topic_links; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.scripture_topic_links IS 'This links the scriptures to the topics.';


--
-- Name: scriptures_id_sq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.scriptures_id_sq
    START WITH 5
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.scriptures_id_sq OWNER TO postgres;

--
-- Name: topic_id_sq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.topic_id_sq
    START WITH 4
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.topic_id_sq OWNER TO postgres;

--
-- Name: topic; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.topic (
    id integer DEFAULT nextval('public.topic_id_sq'::regclass) NOT NULL,
    name character varying(64) NOT NULL
);


ALTER TABLE public.topic OWNER TO postgres;

--
-- Name: scriptures id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.scriptures ALTER COLUMN id SET DEFAULT nextval('public.scriptures_id_seq'::regclass);


--
-- Name: clients email_addrress; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.clients
    ADD CONSTRAINT email_addrress UNIQUE (clientemail);


--
-- Name: ingredient_types ingredient_types_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ingredient_types
    ADD CONSTRAINT ingredient_types_id PRIMARY KEY (id);


--
-- Name: ingredient_types ingredient_types_name; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ingredient_types
    ADD CONSTRAINT ingredient_types_name UNIQUE (name);


--
-- Name: ingredients ingredients_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ingredients
    ADD CONSTRAINT ingredients_id PRIMARY KEY (id);


--
-- Name: ingredients ingredients_title; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ingredients
    ADD CONSTRAINT ingredients_title UNIQUE (title);


--
-- Name: measurements measurements_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.measurements
    ADD CONSTRAINT measurements_id PRIMARY KEY (id);


--
-- Name: measurements name; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.measurements
    ADD CONSTRAINT name UNIQUE (name);


--
-- Name: scriptures pk_scriptures_1; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.scriptures
    ADD CONSTRAINT pk_scriptures_1 PRIMARY KEY (id);


--
-- Name: recipe_categories recipe_categories_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.recipe_categories
    ADD CONSTRAINT recipe_categories_id PRIMARY KEY (id);


--
-- Name: recipe_categories recipe_categories_name; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.recipe_categories
    ADD CONSTRAINT recipe_categories_name UNIQUE (name);


--
-- Name: recipe_ingredients recipe_ingredients_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.recipe_ingredients
    ADD CONSTRAINT recipe_ingredients_id PRIMARY KEY (id);


--
-- Name: recipe_instructions recipe_instructions_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.recipe_instructions
    ADD CONSTRAINT recipe_instructions_id PRIMARY KEY (id);


--
-- Name: recipe_instructions recipe_instructions_recipe_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.recipe_instructions
    ADD CONSTRAINT recipe_instructions_recipe_id UNIQUE (recipes_id);


--
-- Name: CONSTRAINT recipe_instructions_recipe_id ON recipe_instructions; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON CONSTRAINT recipe_instructions_recipe_id ON public.recipe_instructions IS 'Can only have one set of instructions per recipe';


--
-- Name: recipes recipes_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.recipes
    ADD CONSTRAINT recipes_id PRIMARY KEY (id);


--
-- Name: registration registration_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.registration
    ADD CONSTRAINT registration_pkey PRIMARY KEY (id);


--
-- Name: registration registration_reg_pass_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.registration
    ADD CONSTRAINT registration_reg_pass_key UNIQUE (reg_pass);


--
-- Name: scripture_topic_links scripture_topic_links_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.scripture_topic_links
    ADD CONSTRAINT scripture_topic_links_pkey PRIMARY KEY (id);


--
-- Name: recipes title; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.recipes
    ADD CONSTRAINT title UNIQUE (title);


--
-- Name: topic topic_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.topic
    ADD CONSTRAINT topic_pkey PRIMARY KEY (id);


--
-- Name: clients users_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.clients
    ADD CONSTRAINT users_id PRIMARY KEY (id);


--
-- Name: recipes created_user_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.recipes
    ADD CONSTRAINT created_user_id FOREIGN KEY (created_user_id) REFERENCES public.clients(id);


--
-- Name: recipe_ingredients ingredient_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.recipe_ingredients
    ADD CONSTRAINT ingredient_id FOREIGN KEY (ingredient_id) REFERENCES public.ingredients(id);


--
-- Name: ingredients ingredient_type_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ingredients
    ADD CONSTRAINT ingredient_type_id FOREIGN KEY (ingredient_type_id) REFERENCES public.ingredient_types(id);


--
-- Name: recipe_ingredients measurement_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.recipe_ingredients
    ADD CONSTRAINT measurement_id FOREIGN KEY (measurement_id) REFERENCES public.measurements(id);


--
-- Name: recipes recipe_category_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.recipes
    ADD CONSTRAINT recipe_category_id FOREIGN KEY (recipe_category_id) REFERENCES public.recipe_categories(id);


--
-- Name: recipe_ingredients recipes_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.recipe_ingredients
    ADD CONSTRAINT recipes_id FOREIGN KEY (recipes_id) REFERENCES public.recipes(id);


--
-- Name: recipe_instructions recipes_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.recipe_instructions
    ADD CONSTRAINT recipes_id FOREIGN KEY (recipes_id) REFERENCES public.recipes(id);


--
-- Name: recipe_ingredients ri_created_user_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.recipe_ingredients
    ADD CONSTRAINT ri_created_user_id FOREIGN KEY (created_user_id) REFERENCES public.clients(id);


--
-- Name: recipe_instructions rinst_created_user_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.recipe_instructions
    ADD CONSTRAINT rinst_created_user_id FOREIGN KEY (created_user_id) REFERENCES public.clients(id);


--
-- Name: scripture_topic_links scripture_topic_links_scriptures_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.scripture_topic_links
    ADD CONSTRAINT scripture_topic_links_scriptures_id_fkey FOREIGN KEY (scriptures_id) REFERENCES public.scriptures(id);


--
-- Name: scripture_topic_links scripture_topic_links_topic_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.scripture_topic_links
    ADD CONSTRAINT scripture_topic_links_topic_id_fkey FOREIGN KEY (topic_id) REFERENCES public.topic(id);


--
-- PostgreSQL database dump complete
--
