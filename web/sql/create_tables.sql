--
-- yehhzpljklqjgmQL database dump
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
-- Name: users_id_sq; Type: SEQUENCE; Schema: public; Owner: yehhzpljklqjgm
--

CREATE SEQUENCE public.users_id_sq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_sq OWNER TO yehhzpljklqjgm;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: clients; Type: TABLE; Schema: public; Owner: yehhzpljklqjgm
--
DROP TABLE IF EXISTS public.users CASCADE;
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


ALTER TABLE public.clients OWNER TO yehhzpljklqjgm;

--
-- Name: ingredient_types; Type: TABLE; Schema: public; Owner: yehhzpljklqjgm
--
DROP TABLE IF EXISTS public.ingredient_types CASCADE;
CREATE TABLE public.ingredient_types (
    id integer NOT NULL,
    name character varying(50) NOT NULL
);


ALTER TABLE public.ingredient_types OWNER TO yehhzpljklqjgm;

--
-- Name: ingredients_id_sequence; Type: SEQUENCE; Schema: public; Owner: yehhzpljklqjgm
--


ALTER TABLE public.ingredients_id_sequence OWNER TO yehhzpljklqjgm;

--
-- Name: ingredients; Type: TABLE; Schema: public; Owner: yehhzpljklqjgm
--
DROP TABLE IF EXISTS public.ingredients CASCADE;
CREATE TABLE public.ingredients (
    id integer DEFAULT nextval('public.ingredients_id_sequence'::regclass) NOT NULL,
    title character varying(50) NOT NULL,
    ingredient_type_id integer NOT NULL
);


ALTER TABLE public.ingredients OWNER TO yehhzpljklqjgm;

--
-- Name: measurements; Type: TABLE; Schema: public; Owner: yehhzpljklqjgm
--
DROP TABLE IF EXISTS public.measurements CASCADE;
CREATE TABLE public.measurements (
    id integer NOT NULL,
    name character varying NOT NULL
);


ALTER TABLE public.measurements OWNER TO yehhzpljklqjgm;

--
-- Name: recipe_categories; Type: TABLE; Schema: public; Owner: yehhzpljklqjgm
--
DROP TABLE IF EXISTS public.recipe_categories CASCADE;
CREATE TABLE public.recipe_categories (
    id integer NOT NULL,
    name character varying(50) NOT NULL
);


ALTER TABLE public.recipe_categories OWNER TO yehhzpljklqjgm;

--
-- Name: recipe_ingredients_id_s; Type: SEQUENCE; Schema: public; Owner: yehhzpljklqjgm
--


ALTER TABLE public.recipe_ingredients_id_s OWNER TO yehhzpljklqjgm;

--
-- Name: recipe_ingredients; Type: TABLE; Schema: public; Owner: yehhzpljklqjgm
--
DROP TABLE IF EXISTS public.recipe_ingredients CASCADE;
CREATE TABLE public.recipe_ingredients (
    id integer DEFAULT nextval('public.recipe_ingredients_id_s'::regclass) NOT NULL,
    recipes_id integer NOT NULL,
    measurement_id integer,
    ingredient_id integer NOT NULL,
    created_ts timestamp with time zone NOT NULL,
    created_user_id integer NOT NULL,
    measurement_amt character(11) NOT NULL
);


ALTER TABLE public.recipe_ingredients OWNER TO yehhzpljklqjgm;

--
-- Name: recipe_instructions_id_s; Type: SEQUENCE; Schema: public; Owner: yehhzpljklqjgm
--


ALTER TABLE public.recipe_instructions_id_s OWNER TO yehhzpljklqjgm;

--
-- Name: recipe_instructions; Type: TABLE; Schema: public; Owner: yehhzpljklqjgm
--
DROP TABLE IF EXISTS public.recipe_instructions CASCADE;
CREATE TABLE public.recipe_instructions (
    id integer DEFAULT nextval('public.recipe_instructions_id_s'::regclass) NOT NULL,
    recipes_id integer NOT NULL,
    instructions text NOT NULL,
    created_ts timestamp with time zone NOT NULL,
    created_user_id integer NOT NULL
);


ALTER TABLE public.recipe_instructions OWNER TO yehhzpljklqjgm;

--
-- Name: recipes_id_s; Type: SEQUENCE; Schema: public; Owner: yehhzpljklqjgm
--



ALTER TABLE public.recipes_id_s OWNER TO yehhzpljklqjgm;

--
-- Name: recipes; Type: TABLE; Schema: public; Owner: yehhzpljklqjgm
--
DROP TABLE IF EXISTS public.recipes CASCADE;
CREATE TABLE public.recipes (
    id integer DEFAULT nextval('public.recipes_id_s'::regclass) NOT NULL,
    title character varying(50) NOT NULL,
    recipe_category_id integer NOT NULL,
    created_ts timestamp with time zone NOT NULL,
    created_user_id integer NOT NULL,
    image_file character varying(50)
);


ALTER TABLE public.recipes OWNER TO yehhzpljklqjgm;

--
-- Name: registration; Type: TABLE; Schema: public; Owner: yehhzpljklqjgm
--

CREATE TABLE public.registration (
    id integer NOT NULL,
    reg_pass character varying NOT NULL
);


ALTER TABLE public.registration OWNER TO yehhzpljklqjgm;

--
-- Name: scripture_topic_id_sq; Type: SEQUENCE; Schema: public; Owner: yehhzpljklqjgm
--



ALTER TABLE public.scripture_topic_id_sq OWNER TO yehhzpljklqjgm;

--
-- Name: scriptures; Type: TABLE; Schema: public; Owner: yehhzpljklqjgm
--
DROP TABLE IF EXISTS public.scriptures CASCADE;
CREATE TABLE public.scriptures (
    id integer NOT NULL,
    book character varying(30) NOT NULL,
    chapter integer NOT NULL,
    verse integer NOT NULL,
    content text NOT NULL
);


ALTER TABLE public.scriptures OWNER TO yehhzpljklqjgm;

--
-- Name: scriptures_id_seq; Type: SEQUENCE; Schema: public; Owner: yehhzpljklqjgm
--

CREATE SEQUENCE public.scriptures_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER TABLE public.scriptures_id_seq OWNER TO yehhzpljklqjgm;

--
-- Name: scriptures_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: yehhzpljklqjgm
--

ALTER SEQUENCE public.scriptures_id_seq OWNED BY public.scriptures.id;


--
-- Name: scripture_topic_links; Type: TABLE; Schema: public; Owner: yehhzpljklqjgm
--
DROP TABLE IF EXISTS public.scripture_topic_links CASCADE;
CREATE TABLE public.scripture_topic_links (
    id integer DEFAULT nextval('public.scriptures_id_seq'::regclass) NOT NULL,
    scriptures_id integer NOT NULL,
    topic_id integer NOT NULL
);


ALTER TABLE public.scripture_topic_links OWNER TO yehhzpljklqjgm;

--
-- Name: TABLE scripture_topic_links; Type: COMMENT; Schema: public; Owner: yehhzpljklqjgm
--

COMMENT ON TABLE public.scripture_topic_links IS 'This links the scriptures to the topics.';


--
-- Name: scriptures_id_sq; Type: SEQUENCE; Schema: public; Owner: yehhzpljklqjgm
--



ALTER TABLE public.scriptures_id_sq OWNER TO yehhzpljklqjgm;

--
-- Name: topic_id_sq; Type: SEQUENCE; Schema: public; Owner: yehhzpljklqjgm
--



ALTER TABLE public.topic_id_sq OWNER TO yehhzpljklqjgm;

--
-- Name: topic; Type: TABLE; Schema: public; Owner: yehhzpljklqjgm
--
DROP TABLE IF EXISTS public.topic CASCADE;
CREATE TABLE public.topic (
    id integer DEFAULT nextval('public.topic_id_sq'::regclass) NOT NULL,
    name character varying(64) NOT NULL
);


ALTER TABLE public.topic OWNER TO yehhzpljklqjgm;

--
-- Name: scriptures id; Type: DEFAULT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.scriptures ALTER COLUMN id SET DEFAULT nextval('public.scriptures_id_seq'::regclass);


--
-- Data for Name: clients; Type: TABLE DATA; Schema: public; Owner: yehhzpljklqjgm
--

INSERT INTO public.clients VALUES (1, 'loveaphair', 'jfkslafdjslfdsafdsafjkalfda', 'loveaphair@gmail.com', 'Kevin', 'Phair', '2019-02-10 12:01:01-07', 2);
INSERT INTO public.clients VALUES (7, '$2y$10$/U73MHEZImw7POzT8H8Ip.99rjXGqWdfka0ldMxVzMbQg7nO8c.Ri', '5846fd36210111ce499a499a8d418a1f', 'kevin@phair.com', 'Kevin', 'Phair', '2019-02-18 19:21:08-07', 1);
INSERT INTO public.clients VALUES (8, '$2y$10$Q4p7.N7JAfdJWGwLeeJrA.wSNGrU8CW38UtcA45PF7BbhXAUttpYi', '29efd905cc1312a489781241b3aef420', 'kevin@phairs.com', 'Kevin', 'Phair', '2019-02-18 20:10:48-07', 1);


--
-- Data for Name: ingredient_types; Type: TABLE DATA; Schema: public; Owner: yehhzpljklqjgm
--

INSERT INTO public.ingredient_types VALUES (1, 'meat');
INSERT INTO public.ingredient_types VALUES (2, 'dairy');
INSERT INTO public.ingredient_types VALUES (3, 'vegetable');
INSERT INTO public.ingredient_types VALUES (4, 'fruit');
INSERT INTO public.ingredient_types VALUES (5, 'fat');
INSERT INTO public.ingredient_types VALUES (6, 'sugar');
INSERT INTO public.ingredient_types VALUES (7, 'herb/seasoning');


--
-- Data for Name: ingredients; Type: TABLE DATA; Schema: public; Owner: yehhzpljklqjgm
--

INSERT INTO public.ingredients VALUES (1, 'Olive Oil', 5);
INSERT INTO public.ingredients VALUES (2, 'Red Wine Vinegar', 7);
INSERT INTO public.ingredients VALUES (3, 'Coarse Ground Mustard', 7);
INSERT INTO public.ingredients VALUES (4, 'Garlic Powder', 7);
INSERT INTO public.ingredients VALUES (5, 'Salt', 7);
INSERT INTO public.ingredients VALUES (6, 'Freshly Cracked Pepper', 7);
INSERT INTO public.ingredients VALUES (7, 'Kielbasa', 1);
INSERT INTO public.ingredients VALUES (8, 'Onion', 3);
INSERT INTO public.ingredients VALUES (9, 'Cabbage, chopped', 3);
INSERT INTO public.ingredients VALUES (10, 'Cheddar Cheese', 2);
INSERT INTO public.ingredients VALUES (11, 'Milk', 2);
INSERT INTO public.ingredients VALUES (12, 'Eggs', 1);
INSERT INTO public.ingredients VALUES (14, 'Onion Powder', 7);
INSERT INTO public.ingredients VALUES (15, 'Kosher Salt', 7);
INSERT INTO public.ingredients VALUES (16, 'White Pepper', 7);
INSERT INTO public.ingredients VALUES (17, 'Boneless Skinless Chicken Breast', 1);
INSERT INTO public.ingredients VALUES (18, 'Tomato', 3);
INSERT INTO public.ingredients VALUES (19, 'Strawberry', 4);
INSERT INTO public.ingredients VALUES (20, 'Pear', 4);
INSERT INTO public.ingredients VALUES (21, 'Cucumber', 3);
INSERT INTO public.ingredients VALUES (22, 'Banana', 4);
INSERT INTO public.ingredients VALUES (23, 'grape', 4);
INSERT INTO public.ingredients VALUES (24, 'Ginger', 7);
INSERT INTO public.ingredients VALUES (25, 'Peanut Butter', 5);
INSERT INTO public.ingredients VALUES (26, 'Strawberry Jam', 6);
INSERT INTO public.ingredients VALUES (27, 'Slice of Bread', 6);


--
-- Data for Name: measurements; Type: TABLE DATA; Schema: public; Owner: yehhzpljklqjgm
--

INSERT INTO public.measurements VALUES (1, 'tsp');
INSERT INTO public.measurements VALUES (2, 'Tbsp');
INSERT INTO public.measurements VALUES (3, 'Cup');
INSERT INTO public.measurements VALUES (4, 'pinch');
INSERT INTO public.measurements VALUES (5, 'dash');
INSERT INTO public.measurements VALUES (6, 'ounce');
INSERT INTO public.measurements VALUES (7, 'gram');
INSERT INTO public.measurements VALUES (8, 'item');


--
-- Data for Name: recipe_categories; Type: TABLE DATA; Schema: public; Owner: yehhzpljklqjgm
--

INSERT INTO public.recipe_categories VALUES (1, 'Breakfast');
INSERT INTO public.recipe_categories VALUES (2, 'Lunch');
INSERT INTO public.recipe_categories VALUES (3, 'Dinner');
INSERT INTO public.recipe_categories VALUES (4, 'Dessert');


--
-- Data for Name: recipe_ingredients; Type: TABLE DATA; Schema: public; Owner: yehhzpljklqjgm
--

INSERT INTO public.recipe_ingredients VALUES (1, 1, 3, 1, '2019-02-10 12:03:03-07', 1, '1/4        ');
INSERT INTO public.recipe_ingredients VALUES (2, 1, 2, 2, '2019-02-10 12:03:03-07', 1, '2          ');
INSERT INTO public.recipe_ingredients VALUES (3, 1, 2, 3, '2019-02-10 12:03:03-07', 1, '1 1/2      ');
INSERT INTO public.recipe_ingredients VALUES (4, 1, 1, 4, '2019-02-10 12:03:03-07', 1, '1/4        ');
INSERT INTO public.recipe_ingredients VALUES (5, 1, 1, 5, '2019-02-10 12:03:03-07', 1, '1/4        ');
INSERT INTO public.recipe_ingredients VALUES (6, 1, NULL, 6, '2019-02-10 12:03:03-07', 1, '           ');
INSERT INTO public.recipe_ingredients VALUES (7, 1, 6, 7, '2019-02-10 12:03:03-07', 1, '14         ');
INSERT INTO public.recipe_ingredients VALUES (8, 1, NULL, 8, '2019-02-10 12:03:03-07', 1, '1          ');
INSERT INTO public.recipe_ingredients VALUES (9, 1, 3, 9, '2019-02-10 12:03:03-07', 1, '6          ');
INSERT INTO public.recipe_ingredients VALUES (83, 28, 2, 25, '2019-02-18 20:23:36-07', 1, '3          ');
INSERT INTO public.recipe_ingredients VALUES (84, 28, 1, 26, '2019-02-18 20:23:36-07', 1, '5          ');
INSERT INTO public.recipe_ingredients VALUES (85, 28, 8, 27, '2019-02-18 20:23:36-07', 1, '2          ');


--
-- Data for Name: recipe_instructions; Type: TABLE DATA; Schema: public; Owner: yehhzpljklqjgm
--

INSERT INTO public.recipe_instructions VALUES (1, 1, 'Prepare the vinaigrette by adding the olive oil, vinegar, mustard, garlic powder, salt, and some freshly cracked pepper to a bowl or jar. Whisk or shake the jar until the ingredients are combined, then set the vinaigrette aside.---
Slice the kielbasa into medallions or half-rounds and add them to a large skillet (12" or larger) or a large, wide-bottomed pot, along with the olive oil. Sauté the sausage over medium heat until the pieces are well browned.---
While the sausage is browning, finely dice the onion. Once the sausage has fully browned, add the onions and continue to sauté until the onions are soft and transparent.---
While the onions are sautéing, chop the head of cabbage into 2-inch by  1/2-inch wide strips. Add the cabbage to the skillet or pot along with a pinch of salt and pepper. ---Continue to sauté until the cabbage is tender (check the thickest white pieces for tenderness). To help the cabbage soften, add a few tablespoons of water to create steam within the pot or skillet. Let the water evaporate as you sauté the cabbage.---
Once tender, drizzle the mustard vinaigrette over the skillet, starting with just half of the prepared amount. Stir to coat the kielbasa and cabbage in the vinaigrette, taste, and add more if needed. Serve warm.', '2019-02-10 12:16:16-07', 1);
INSERT INTO public.recipe_instructions VALUES (23, 28, 'make the stinkin&#039; sandwich, homie!', '2019-02-16 17:10:12-07', 1);


--
-- Data for Name: recipes; Type: TABLE DATA; Schema: public; Owner: yehhzpljklqjgm
--

INSERT INTO public.recipes VALUES (1, 'Kielbasa and Cabbage Skillet', 3, '2019-02-10 12:01:00-07', 1, 'kskillet.jpg');
INSERT INTO public.recipes VALUES (28, 'Peanut Butter and Jelly Sandwich', 2, '2019-02-16 17:10:12-07', 1, NULL);


--
-- Data for Name: registration; Type: TABLE DATA; Schema: public; Owner: yehhzpljklqjgm
--

INSERT INTO public.registration VALUES (1, 'RN4NF943');


--
-- Data for Name: scripture_topic_links; Type: TABLE DATA; Schema: public; Owner: yehhzpljklqjgm
--

INSERT INTO public.scripture_topic_links VALUES (22, 21, 1);
INSERT INTO public.scripture_topic_links VALUES (23, 21, 2);
INSERT INTO public.scripture_topic_links VALUES (25, 24, 1);
INSERT INTO public.scripture_topic_links VALUES (26, 24, 3);
INSERT INTO public.scripture_topic_links VALUES (28, 27, 3);
INSERT INTO public.scripture_topic_links VALUES (30, 29, 4);


--
-- Data for Name: scriptures; Type: TABLE DATA; Schema: public; Owner: yehhzpljklqjgm
--

INSERT INTO public.scriptures VALUES (1, 'John', 1, 5, 'And the light shineth in darkness; and the darkness comprehended it not.');
INSERT INTO public.scriptures VALUES (2, 'Doctrine and Covenants', 88, 49, 'The light shineth in darkness, and the darkness comprehendeth it not; nevertheless,
          the day shall come when you shall comprehend even God, being quickened in him and by him.');
INSERT INTO public.scriptures VALUES (3, 'Doctrine and Covenants', 93, 28, 'He that keepeth his commandments receiveth truth and light, until he is glorified in
       truth and knoweth all things.');
INSERT INTO public.scriptures VALUES (4, 'Mosiah', 16, 9, 'He is the light and the life of the world; yea, a light that is endless, that can
        never be darkened; yea, and also a life which is endless, that there can be no more death.');
INSERT INTO public.scriptures VALUES (21, 'Hebrews', 11, 4, 'By faith Abel offered unto God a more excellent sacrifice than Cain, by which he obtained witness that he was righteous, God testifying of his gifts: and by it he being dead yet speaketh.');
INSERT INTO public.scriptures VALUES (24, '1 Corinthians', 13, 13, ' And now bideth faith, hope, charity, these three; but the greatest of these is charity.Content...');
INSERT INTO public.scriptures VALUES (27, 'Moroni', 7, 47, 'But charity is the pure love of Christ, and it endureth forever; and whoso is found possessed of it at the last day, it shall be well with him.');
INSERT INTO public.scriptures VALUES (29, 'James', 1, 5, 'If any of you lack wisdom, let him ask of God, that giveth to all men liberally, and upbraideth not; and it shall be given him.');


--
-- Data for Name: topic; Type: TABLE DATA; Schema: public; Owner: yehhzpljklqjgm
--

INSERT INTO public.topic VALUES (1, 'Faith');
INSERT INTO public.topic VALUES (2, 'Sacrifice');
INSERT INTO public.topic VALUES (3, 'Charity');
INSERT INTO public.topic VALUES (4, 'Prayer');


--
-- Name: ingredients_id_sequence; Type: SEQUENCE SET; Schema: public; Owner: yehhzpljklqjgm
--

SELECT pg_catalog.setval('public.ingredients_id_sequence', 27, true);


--
-- Name: recipe_ingredients_id_s; Type: SEQUENCE SET; Schema: public; Owner: yehhzpljklqjgm
--

SELECT pg_catalog.setval('public.recipe_ingredients_id_s', 85, true);


--
-- Name: recipe_instructions_id_s; Type: SEQUENCE SET; Schema: public; Owner: yehhzpljklqjgm
--

SELECT pg_catalog.setval('public.recipe_instructions_id_s', 23, true);


--
-- Name: recipes_id_s; Type: SEQUENCE SET; Schema: public; Owner: yehhzpljklqjgm
--

SELECT pg_catalog.setval('public.recipes_id_s', 28, true);


--
-- Name: scripture_topic_id_sq; Type: SEQUENCE SET; Schema: public; Owner: yehhzpljklqjgm
--

SELECT pg_catalog.setval('public.scripture_topic_id_sq', 1, false);


--
-- Name: scriptures_id_seq; Type: SEQUENCE SET; Schema: public; Owner: yehhzpljklqjgm
--

SELECT pg_catalog.setval('public.scriptures_id_seq', 30, true);


--
-- Name: scriptures_id_sq; Type: SEQUENCE SET; Schema: public; Owner: yehhzpljklqjgm
--

SELECT pg_catalog.setval('public.scriptures_id_sq', 5, false);


--
-- Name: topic_id_sq; Type: SEQUENCE SET; Schema: public; Owner: yehhzpljklqjgm
--

SELECT pg_catalog.setval('public.topic_id_sq', 4, true);


--
-- Name: users_id_sq; Type: SEQUENCE SET; Schema: public; Owner: yehhzpljklqjgm
--

SELECT pg_catalog.setval('public.users_id_sq', 8, true);


--
-- Name: clients email_addrress; Type: CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--



--
-- Name: ingredient_types ingredient_types_id; Type: CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.ingredient_types
    ADD CONSTRAINT ingredient_types_id PRIMARY KEY (id);


--
-- Name: ingredient_types ingredient_types_name; Type: CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.ingredient_types
    ADD CONSTRAINT ingredient_types_name UNIQUE (name);


--
-- Name: ingredients ingredients_id; Type: CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.ingredients
    ADD CONSTRAINT ingredients_id PRIMARY KEY (id);


--
-- Name: ingredients ingredients_title; Type: CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.ingredients
    ADD CONSTRAINT ingredients_title UNIQUE (title);


--
-- Name: measurements measurements_id; Type: CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.measurements
    ADD CONSTRAINT measurements_id PRIMARY KEY (id);


--
-- Name: measurements name; Type: CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.measurements
    ADD CONSTRAINT name UNIQUE (name);


--
-- Name: scriptures pk_scriptures_1; Type: CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.scriptures
    ADD CONSTRAINT pk_scriptures_1 PRIMARY KEY (id);


--
-- Name: recipe_categories recipe_categories_id; Type: CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.recipe_categories
    ADD CONSTRAINT recipe_categories_id PRIMARY KEY (id);


--
-- Name: recipe_categories recipe_categories_name; Type: CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.recipe_categories
    ADD CONSTRAINT recipe_categories_name UNIQUE (name);


--
-- Name: recipe_ingredients recipe_ingredients_id; Type: CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.recipe_ingredients
    ADD CONSTRAINT recipe_ingredients_id PRIMARY KEY (id);


--
-- Name: recipe_instructions recipe_instructions_id; Type: CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.recipe_instructions
    ADD CONSTRAINT recipe_instructions_id PRIMARY KEY (id);


--
-- Name: recipe_instructions recipe_instructions_recipe_id; Type: CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.recipe_instructions
    ADD CONSTRAINT recipe_instructions_recipe_id UNIQUE (recipes_id);


--
-- Name: CONSTRAINT recipe_instructions_recipe_id ON recipe_instructions; Type: COMMENT; Schema: public; Owner: yehhzpljklqjgm
--

COMMENT ON CONSTRAINT recipe_instructions_recipe_id ON public.recipe_instructions IS 'Can only have one set of instructions per recipe';


--
-- Name: recipes recipes_id; Type: CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.recipes
    ADD CONSTRAINT recipes_id PRIMARY KEY (id);


--
-- Name: registration registration_pkey; Type: CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.registration
    ADD CONSTRAINT registration_pkey PRIMARY KEY (id);


--
-- Name: registration registration_reg_pass_key; Type: CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.registration
    ADD CONSTRAINT registration_reg_pass_key UNIQUE (reg_pass);


--
-- Name: scripture_topic_links scripture_topic_links_pkey; Type: CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.scripture_topic_links
    ADD CONSTRAINT scripture_topic_links_pkey PRIMARY KEY (id);


--
-- Name: recipes title; Type: CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.recipes
    ADD CONSTRAINT title UNIQUE (title);


--
-- Name: topic topic_pkey; Type: CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.topic
    ADD CONSTRAINT topic_pkey PRIMARY KEY (id);


--
-- Name: clients users_id; Type: CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.clients
    ADD CONSTRAINT users_id PRIMARY KEY (id);


--
-- Name: recipes created_user_id; Type: FK CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.recipes
    ADD CONSTRAINT created_user_id FOREIGN KEY (created_user_id) REFERENCES public.clients(id);


--
-- Name: recipe_ingredients ingredient_id; Type: FK CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.recipe_ingredients
    ADD CONSTRAINT ingredient_id FOREIGN KEY (ingredient_id) REFERENCES public.ingredients(id);


--
-- Name: ingredients ingredient_type_id; Type: FK CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.ingredients
    ADD CONSTRAINT ingredient_type_id FOREIGN KEY (ingredient_type_id) REFERENCES public.ingredient_types(id);


--
-- Name: recipe_ingredients measurement_id; Type: FK CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.recipe_ingredients
    ADD CONSTRAINT measurement_id FOREIGN KEY (measurement_id) REFERENCES public.measurements(id);


--
-- Name: recipes recipe_category_id; Type: FK CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.recipes
    ADD CONSTRAINT recipe_category_id FOREIGN KEY (recipe_category_id) REFERENCES public.recipe_categories(id);


--
-- Name: recipe_ingredients recipes_id; Type: FK CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.recipe_ingredients
    ADD CONSTRAINT recipes_id FOREIGN KEY (recipes_id) REFERENCES public.recipes(id);


--
-- Name: recipe_instructions recipes_id; Type: FK CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.recipe_instructions
    ADD CONSTRAINT recipes_id FOREIGN KEY (recipes_id) REFERENCES public.recipes(id);


--
-- Name: recipe_ingredients ri_created_user_id; Type: FK CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.recipe_ingredients
    ADD CONSTRAINT ri_created_user_id FOREIGN KEY (created_user_id) REFERENCES public.clients(id);


--
-- Name: recipe_instructions rinst_created_user_id; Type: FK CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.recipe_instructions
    ADD CONSTRAINT rinst_created_user_id FOREIGN KEY (created_user_id) REFERENCES public.clients(id);


--
-- Name: scripture_topic_links scripture_topic_links_scriptures_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.scripture_topic_links
    ADD CONSTRAINT scripture_topic_links_scriptures_id_fkey FOREIGN KEY (scriptures_id) REFERENCES public.scriptures(id);


--
-- Name: scripture_topic_links scripture_topic_links_topic_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: yehhzpljklqjgm
--

ALTER TABLE ONLY public.scripture_topic_links
    ADD CONSTRAINT scripture_topic_links_topic_id_fkey FOREIGN KEY (topic_id) REFERENCES public.topic(id);


--
-- yehhzpljklqjgmQL database dump complete
--
