CREATE TABLE public.topic (
    id integer NOT NULL,
    name character varying(64) NOT NULL
);

ALTER TABLE public.topic OWNER TO postgres;

ALTER TABLE ONLY public.topic
    ADD CONSTRAINT topic_pkey PRIMARY KEY (id);

INSERT INTO public.topic(id, name) VALUES 
('1', 'Faith'), ('2', 'Sacrifice'), ('3','Charity');

CREATE TABLE public.scripture_topic_links (
    id integer NOT NULL,
    scriptures_id integer NOT NULL,
    topic_id integer NOT NULL
);

ALTER TABLE public.scripture_topic_links OWNER TO postgres;

COMMENT ON TABLE public.scripture_topic_links IS 'This links the scriptures to the topics.';

ALTER TABLE ONLY public.scripture_topic_links
    ADD CONSTRAINT scripture_topic_links_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.scripture_topic_links
    ADD CONSTRAINT scripture_topic_links_scriptures_id_fkey FOREIGN KEY (scriptures_id) REFERENCES public.scriptures(id);

ALTER TABLE ONLY public.scripture_topic_links
    ADD CONSTRAINT scripture_topic_links_topic_id_fkey FOREIGN KEY (topic_id) REFERENCES public.topic(id);

CREATE SEQUENCE scriptures_id_sq START WITH 5;
CREATE SEQUENCE scripture_topic_id_sq START WITH 1;
CREATE SEQUENCE topic_id_sq START WITH 4;