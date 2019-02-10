CREATE TABLE public.users
(
    id integer NOT NULL,
    username character varying(50) NOT NULL,
    password character varying(255) NOT NULL,
    email_address character varying(50) NOT NULL,
    first_name character varying(50) NOT NULL,
    last_name character varying(50) NOT NULL,
    created_at timestamp with time zone NOT NULL,
    CONSTRAINT users_id PRIMARY KEY (id),
    CONSTRAINT email_addrress UNIQUE (email_address)

);

CREATE TABLE public.recipe_categories
(
    id integer NOT NULL,
    name character varying(50) NOT NULL,
    CONSTRAINT recipe_categories_id PRIMARY KEY (id),
    CONSTRAINT recipe_categories_name UNIQUE (name)

);

CREATE TABLE public.recipes
(
    id integer NOT NULL,
    title character varying(50) NOT NULL,
    recipe_category_id integer NOT NULL,
    created_ts timestamp with time zone NOT NULL,
    created_user_id integer NOT NULL,
    CONSTRAINT recipes_id PRIMARY KEY (id),
    CONSTRAINT title UNIQUE (title)
,
    CONSTRAINT recipe_category_id FOREIGN KEY (recipe_category_id)
        REFERENCES public.recipe_categories (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT created_user_id FOREIGN KEY (created_user_id)
        REFERENCES public.users (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

CREATE TABLE public.measurements
(
    id integer NOT NULL,
    name character varying NOT NULL,
    CONSTRAINT measurements_id PRIMARY KEY (id),
    CONSTRAINT name UNIQUE (name)

);

CREATE TABLE public.ingredient_types
(
    id integer NOT NULL,
    name character varying(50) NOT NULL,
    CONSTRAINT ingredient_types_id PRIMARY KEY (id),
    CONSTRAINT ingredient_types_name UNIQUE (name)

);

CREATE TABLE public.ingredients
(
    id integer NOT NULL,
    title character varying(50) NOT NULL,
    ingredient_type_id integer NOT NULL,
    CONSTRAINT ingredients_id PRIMARY KEY (id),
    CONSTRAINT ingredients_title UNIQUE (title)
,
    CONSTRAINT ingredient_type_id FOREIGN KEY (ingredient_type_id)
        REFERENCES public.ingredient_types (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

CREATE TABLE public.recipe_ingredients
(
    id integer NOT NULL,
    recipes_id integer NOT NULL,
    measurement_id integer NOT NULL,
    ingredient_id integer NOT NULL,
    created_ts timestamp with time zone NOT NULL,
    created_user_id integer NOT NULL,
    CONSTRAINT recipe_ingredients_id PRIMARY KEY (id),
    CONSTRAINT recipes_id FOREIGN KEY (recipes_id)
        REFERENCES public.recipes (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT measurement_id FOREIGN KEY (measurement_id)
        REFERENCES public.measurements (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT ingredient_id FOREIGN KEY (ingredient_id)
        REFERENCES public.ingredients (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT ri_created_user_id FOREIGN KEY (created_user_id)
        REFERENCES public.users (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

CREATE TABLE public.recipe_instructions
(
    id integer NOT NULL,
    recipes_id integer NOT NULL,
    instructions text NOT NULL,
    created_ts timestamp with time zone NOT NULL,
    created_user_id integer NOT NULL,
    CONSTRAINT recipe_instructions_id PRIMARY KEY (id),
    CONSTRAINT recipe_instructions_recipe_id UNIQUE (recipes_id)
,
    CONSTRAINT recipes_id FOREIGN KEY (recipes_id)
        REFERENCES public.recipes (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT rinst_created_user_id FOREIGN KEY (created_user_id)
        REFERENCES public.users (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

COMMENT ON CONSTRAINT recipe_instructions_recipe_id ON public.recipe_instructions
    IS 'Can only have one set of instructions per recipe';