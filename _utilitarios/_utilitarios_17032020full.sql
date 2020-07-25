--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.10
-- Dumped by pg_dump version 9.6.10

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
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: _bills_to_receive; Type: TABLE; Schema: public; Owner: rebasedata
--

CREATE TABLE public.bills_to_receive (
    receive_id character varying(1) DEFAULT NULL::character varying,
    receive_venc character varying(1) DEFAULT NULL::character varying,
    receive_date_pay character varying(1) DEFAULT NULL::character varying,
    receive_cat character varying(1) DEFAULT NULL::character varying,
    receive_desc character varying(1) DEFAULT NULL::character varying,
    receive_val character varying(1) DEFAULT NULL::character varying,
    receive_created character varying(1) DEFAULT NULL::character varying,
    receive_modified character varying(1) DEFAULT NULL::character varying,
    receive_status character varying(1) DEFAULT NULL::character varying
);


ALTER TABLE public.bills_to_receive OWNER TO rebasedata;

--
-- Name: _calendar; Type: TABLE; Schema: public; Owner: rebasedata
--

CREATE TABLE public.calendar (
    calendar_id character varying(1) DEFAULT NULL::character varying,
    calendar_start character varying(1) DEFAULT NULL::character varying,
    calendar_end character varying(1) DEFAULT NULL::character varying,
    calendar_start_normal character varying(1) DEFAULT NULL::character varying,
    calendar_end_normal character varying(1) DEFAULT NULL::character varying,
    calendar_class character varying(1) DEFAULT NULL::character varying,
    calendar_proc character varying(1) DEFAULT NULL::character varying,
    calendar_pat character varying(1) DEFAULT NULL::character varying,
    calendar_desc character varying(1) DEFAULT NULL::character varying
);


ALTER TABLE public.calendar OWNER TO rebasedata;

--
-- Name: _cash_flow; Type: TABLE; Schema: public; Owner: rebasedata
--

CREATE TABLE public.cash_flow (
    flow_id character varying(1) DEFAULT NULL::character varying,
    flow_venc character varying(1) DEFAULT NULL::character varying,
    flow_date_pay character varying(1) DEFAULT NULL::character varying,
    flow_cat character varying(1) DEFAULT NULL::character varying,
    flow_desc character varying(1) DEFAULT NULL::character varying,
    flow_val character varying(1) DEFAULT NULL::character varying,
    flow_created character varying(1) DEFAULT NULL::character varying,
    flow_modified character varying(1) DEFAULT NULL::character varying,
    flow_status character varying(1) DEFAULT NULL::character varying
);


ALTER TABLE public.cash_flow OWNER TO rebasedata;

--
-- Name: _checks; Type: TABLE; Schema: public; Owner: rebasedata
--

CREATE TABLE public.checks (
    checks_id character varying(1) DEFAULT NULL::character varying,
    checks_holder character varying(1) DEFAULT NULL::character varying,
    checks_val character varying(1) DEFAULT NULL::character varying,
    checks_cod character varying(1) DEFAULT NULL::character varying,
    checks_bank character varying(1) DEFAULT NULL::character varying,
    checks_agency character varying(1) DEFAULT NULL::character varying,
    checks_date character varying(1) DEFAULT NULL::character varying,
    checks_received character varying(1) DEFAULT NULL::character varying,
    checks_forwarded character varying(1) DEFAULT NULL::character varying,
    checks_created character varying(1) DEFAULT NULL::character varying,
    checks_modified character varying(1) DEFAULT NULL::character varying
);


ALTER TABLE public.checks OWNER TO rebasedata;

--
-- Name: _company; Type: TABLE; Schema: public; Owner: rebasedata
--

CREATE TABLE public.company (
    company_id character varying(1) DEFAULT NULL::character varying,
    company_name character varying(1) DEFAULT NULL::character varying
);


ALTER TABLE public.company OWNER TO rebasedata;

--
-- Name: _covenant; Type: TABLE; Schema: public; Owner: rebasedata
--

CREATE TABLE public.covenant (
    covenant_id character varying(1) DEFAULT NULL::character varying,
    covenant_name character varying(1) DEFAULT NULL::character varying,
    covenant_cpf_cnpj character varying(1) DEFAULT NULL::character varying,
    covenant_rs character varying(1) DEFAULT NULL::character varying,
    covenant_at character varying(1) DEFAULT NULL::character varying,
    covenant_end character varying(1) DEFAULT NULL::character varying,
    covenant_district character varying(1) DEFAULT NULL::character varying,
    covenant_city character varying(1) DEFAULT NULL::character varying,
    covenant_uf character varying(1) DEFAULT NULL::character varying,
    covenant_cep character varying(1) DEFAULT NULL::character varying,
    covenant_nation character varying(1) DEFAULT NULL::character varying,
    covenant_cel character varying(1) DEFAULT NULL::character varying,
    covenant_tel_1 character varying(1) DEFAULT NULL::character varying,
    covenant_tel_2 character varying(1) DEFAULT NULL::character varying,
    covenant_insc_uf character varying(1) DEFAULT NULL::character varying,
    covenant_web_url character varying(1) DEFAULT NULL::character varying,
    covenant_sit character varying(1) DEFAULT NULL::character varying,
    covenant_email character varying(1) DEFAULT NULL::character varying,
    covenant_rep_name character varying(1) DEFAULT NULL::character varying,
    covenant_rep_nick character varying(1) DEFAULT NULL::character varying,
    covenant_rep_cel character varying(1) DEFAULT NULL::character varying,
    covenant_rep_tel_1 character varying(1) DEFAULT NULL::character varying,
    covenant_rep_tel_2 character varying(1) DEFAULT NULL::character varying,
    covenant_rep_email character varying(1) DEFAULT NULL::character varying,
    covenant_banco_1 character varying(1) DEFAULT NULL::character varying,
    covenant_agencia_1 character varying(1) DEFAULT NULL::character varying,
    covenant_conta_1 character varying(1) DEFAULT NULL::character varying,
    covenant_titular_1 character varying(1) DEFAULT NULL::character varying,
    covenant_banco_2 character varying(1) DEFAULT NULL::character varying,
    covenant_agencia_2 character varying(1) DEFAULT NULL::character varying,
    covenant_conta_2 character varying(1) DEFAULT NULL::character varying,
    covenant_titular_2 character varying(1) DEFAULT NULL::character varying,
    covenant_obs character varying(1) DEFAULT NULL::character varying,
    covenant_created character varying(1) DEFAULT NULL::character varying,
    covenant_modified character varying(1) DEFAULT NULL::character varying
);


ALTER TABLE public.covenant OWNER TO rebasedata;

--
-- Name: _fees; Type: TABLE; Schema: public; Owner: rebasedata
--

CREATE TABLE public.fees (
    fees_id character varying(1) DEFAULT NULL::character varying,
    covenant_id character varying(1) DEFAULT NULL::character varying,
    fees_cod character varying(1) DEFAULT NULL::character varying,
    fees_proc character varying(1) DEFAULT NULL::character varying,
    fees_cat character varying(1) DEFAULT NULL::character varying,
    fees_val_real character varying(1) DEFAULT NULL::character varying,
    fees_desc character varying(1) DEFAULT NULL::character varying,
    fees_val_final character varying(1) DEFAULT NULL::character varying,
    fees_obs character varying(1) DEFAULT NULL::character varying,
    fees_created character varying(1) DEFAULT NULL::character varying,
    fees_modified character varying(1) DEFAULT NULL::character varying
);


ALTER TABLE public.fees OWNER TO rebasedata;

--
-- Name: _laboratory; Type: TABLE; Schema: public; Owner: rebasedata
--

CREATE TABLE public.laboratory (
    laboratory_id character varying(1) DEFAULT NULL::character varying,
    laboratory_name character varying(1) DEFAULT NULL::character varying,
    laboratory_cpf_cnpj character varying(1) DEFAULT NULL::character varying,
    laboratory_rs character varying(1) DEFAULT NULL::character varying,
    laboratory_at character varying(1) DEFAULT NULL::character varying,
    laboratory_end character varying(1) DEFAULT NULL::character varying,
    laboratory_district character varying(1) DEFAULT NULL::character varying,
    laboratory_city character varying(1) DEFAULT NULL::character varying,
    laboratory_cep character varying(1) DEFAULT NULL::character varying,
    laboratory_uf character varying(1) DEFAULT NULL::character varying,
    laboratory_nation character varying(1) DEFAULT NULL::character varying,
    laboratory_cel character varying(1) DEFAULT NULL::character varying,
    laboratory_tel_1 character varying(1) DEFAULT NULL::character varying,
    laboratory_tel_2 character varying(1) DEFAULT NULL::character varying,
    laboratory_insc_uf character varying(1) DEFAULT NULL::character varying,
    laboratory_email character varying(1) DEFAULT NULL::character varying,
    laboratory_web_url character varying(1) DEFAULT NULL::character varying,
    laboratory_sit character varying(1) DEFAULT NULL::character varying,
    laboratory_conta_2 character varying(1) DEFAULT NULL::character varying,
    laboratory_rep_nome character varying(1) DEFAULT NULL::character varying,
    laboratory_rep_apelido character varying(1) DEFAULT NULL::character varying,
    laboratory_rep_email character varying(1) DEFAULT NULL::character varying,
    laboratory_rep_cel character varying(1) DEFAULT NULL::character varying,
    laboratory_rep_tel_1 character varying(1) DEFAULT NULL::character varying,
    laboratory_rep_tel_2 character varying(1) DEFAULT NULL::character varying,
    laboratory_banco_1 character varying(1) DEFAULT NULL::character varying,
    laboratory_agencia_1 character varying(1) DEFAULT NULL::character varying,
    laboratory_conta_1 character varying(1) DEFAULT NULL::character varying,
    laboratory_titular_1 character varying(1) DEFAULT NULL::character varying,
    laboratory_banco_2 character varying(1) DEFAULT NULL::character varying,
    laboratory_agencia_2 character varying(1) DEFAULT NULL::character varying,
    laboratory_titular_2 character varying(1) DEFAULT NULL::character varying,
    laboratory_obs character varying(1) DEFAULT NULL::character varying,
    laboratory_created character varying(1) DEFAULT NULL::character varying,
    laboratory_modified character varying(1) DEFAULT NULL::character varying
);


ALTER TABLE public.laboratory OWNER TO rebasedata;

--
-- Name: _login_attempts; Type: TABLE; Schema: public; Owner: rebasedata
--

CREATE TABLE public.login_attempts (
    login_attempts_id character varying(1) DEFAULT NULL::character varying,
    login_attempts_users_id character varying(1) DEFAULT NULL::character varying,
    created_at character varying(1) DEFAULT NULL::character varying
);


ALTER TABLE public._login_attempts OWNER TO rebasedata;

--
-- Name: _patrimony; Type: TABLE; Schema: public; Owner: rebasedata
--

CREATE TABLE public.patrimony (
    patrimony_id character varying(1) DEFAULT NULL::character varying,
    patrimony_cod character varying(1) DEFAULT NULL::character varying,
    patrimony_desc character varying(1) DEFAULT NULL::character varying,
    patrimony_data_aq character varying(1) DEFAULT NULL::character varying,
    patrimony_cor character varying(1) DEFAULT NULL::character varying,
    patrimony_for character varying(1) DEFAULT NULL::character varying,
    patrimony_dimen character varying(1) DEFAULT NULL::character varying,
    patrimony_setor character varying(1) DEFAULT NULL::character varying,
    patrimony_valor character varying(1) DEFAULT NULL::character varying,
    patrimony_garan character varying(1) DEFAULT NULL::character varying,
    patrimony_quant character varying(1) DEFAULT NULL::character varying,
    patrimony_nf character varying(1) DEFAULT NULL::character varying,
    patrimony_sit character varying(1) DEFAULT NULL::character varying,
    patrimony_obs character varying(1) DEFAULT NULL::character varying,
    patrimony_created character varying(1) DEFAULT NULL::character varying,
    patrimony_modified character varying(1) DEFAULT NULL::character varying
);


ALTER TABLE public.patrimony OWNER TO rebasedata;

--
-- Name: _payments; Type: TABLE; Schema: public; Owner: rebasedata
--

CREATE TABLE public.payments (
    payments_id character varying(1) DEFAULT NULL::character varying,
    payments_venc character varying(1) DEFAULT NULL::character varying,
    payments_date_pay character varying(1) DEFAULT NULL::character varying,
    payments_cat character varying(1) DEFAULT NULL::character varying,
    payments_desc character varying(1) DEFAULT NULL::character varying,
    payments_val character varying(1) DEFAULT NULL::character varying,
    payments_created character varying(1) DEFAULT NULL::character varying,
    payments_modified character varying(1) DEFAULT NULL::character varying,
    payments_status character varying(1) DEFAULT NULL::character varying
);


ALTER TABLE public._payments OWNER TO rebasedata;

--
-- Name: _providers; Type: TABLE; Schema: public; Owner: rebasedata
--

CREATE TABLE public._providers (
    provider_id character varying(1) DEFAULT NULL::character varying,
    provider_name character varying(1) DEFAULT NULL::character varying,
    provider_cpf_cnpj character varying(1) DEFAULT NULL::character varying,
    provider_rs character varying(1) DEFAULT NULL::character varying,
    provider_at character varying(1) DEFAULT NULL::character varying,
    provider_end character varying(1) DEFAULT NULL::character varying,
    provider_district character varying(1) DEFAULT NULL::character varying,
    provider_city character varying(1) DEFAULT NULL::character varying,
    provider_uf character varying(1) DEFAULT NULL::character varying,
    provider_cep character varying(1) DEFAULT NULL::character varying,
    provider_nation character varying(1) DEFAULT NULL::character varying,
    provider_cel character varying(1) DEFAULT NULL::character varying,
    provider_tel_1 character varying(1) DEFAULT NULL::character varying,
    provider_tel_2 character varying(1) DEFAULT NULL::character varying,
    provider_insc_uf character varying(1) DEFAULT NULL::character varying,
    provider_web_url character varying(1) DEFAULT NULL::character varying,
    provider_sit character varying(1) DEFAULT NULL::character varying,
    provider_email character varying(1) DEFAULT NULL::character varying,
    provider_rep_name character varying(1) DEFAULT NULL::character varying,
    provider_rep_apelido character varying(1) DEFAULT NULL::character varying,
    provider_rep_cel character varying(1) DEFAULT NULL::character varying,
    provider_rep_tel_1 character varying(1) DEFAULT NULL::character varying,
    provider_rep_tel_2 character varying(1) DEFAULT NULL::character varying,
    provider_rep_email character varying(1) DEFAULT NULL::character varying,
    provider_banco_1 character varying(1) DEFAULT NULL::character varying,
    provider_agencia_1 character varying(1) DEFAULT NULL::character varying,
    provider_conta_1 character varying(1) DEFAULT NULL::character varying,
    provider_titular_1 character varying(1) DEFAULT NULL::character varying,
    provider_banco_2 character varying(1) DEFAULT NULL::character varying,
    provider_agencia_2 character varying(1) DEFAULT NULL::character varying,
    provider_conta_2 character varying(1) DEFAULT NULL::character varying,
    provider_titular_2 character varying(1) DEFAULT NULL::character varying,
    provider_obs character varying(1) DEFAULT NULL::character varying,
    provider_created character varying(1) DEFAULT NULL::character varying,
    provider_modified character varying(1) DEFAULT NULL::character varying
);


ALTER TABLE public._providers OWNER TO rebasedata;

--
-- Name: _query_data; Type: TABLE; Schema: public; Owner: rebasedata
--

CREATE TABLE public._query_data (
    id character varying(1) DEFAULT NULL::character varying,
    name character varying(1) DEFAULT NULL::character varying,
    "timestamp" character varying(1) DEFAULT NULL::character varying,
    querycount character varying(1) DEFAULT NULL::character varying
);


ALTER TABLE public._query_data OWNER TO rebasedata;

--
-- Name: _recoveries; Type: TABLE; Schema: public; Owner: rebasedata
--

CREATE TABLE public._recoveries (
    recovery_id character varying(1) DEFAULT NULL::character varying,
    recovery_users_id character varying(1) DEFAULT NULL::character varying,
    recovery_token character varying(1) DEFAULT NULL::character varying,
    recovery_status character varying(1) DEFAULT NULL::character varying
);


ALTER TABLE public._recoveries OWNER TO rebasedata;

--
-- Name: _roles; Type: TABLE; Schema: public; Owner: rebasedata
--

CREATE TABLE public._roles (
    role_id character varying(1) DEFAULT NULL::character varying,
    role_level character varying(1) DEFAULT NULL::character varying
);


ALTER TABLE public._roles OWNER TO rebasedata;

--
-- Name: _stock; Type: TABLE; Schema: public; Owner: rebasedata
--

CREATE TABLE public._stock (
    stock_id character varying(1) DEFAULT NULL::character varying,
    stock_cod character varying(1) DEFAULT NULL::character varying,
    stock_desc character varying(1) DEFAULT NULL::character varying,
    stock_tipo_unit character varying(1) DEFAULT NULL::character varying,
    stock_forn character varying(1) DEFAULT NULL::character varying,
    stock_inicial character varying(1) DEFAULT NULL::character varying,
    stock_minimo character varying(1) DEFAULT NULL::character varying,
    stock_atual character varying(1) DEFAULT NULL::character varying,
    stock_prec character varying(1) DEFAULT NULL::character varying,
    stock_obs character varying(1) DEFAULT NULL::character varying,
    stock_created character varying(1) DEFAULT NULL::character varying,
    stock_modified character varying(1) DEFAULT NULL::character varying
);


ALTER TABLE public._stock OWNER TO rebasedata;

--
-- Name: _stock_tipo_unitario; Type: TABLE; Schema: public; Owner: rebasedata
--

CREATE TABLE public._stock_tipo_unitario (
    tipo_unitario_id character varying(1) DEFAULT NULL::character varying,
    tipo_unitario character varying(1) DEFAULT NULL::character varying
);


ALTER TABLE public._stock_tipo_unitario OWNER TO rebasedata;

--
-- Name: _users; Type: TABLE; Schema: public; Owner: rebasedata
--

CREATE TABLE public._users (
    user_id character varying(1) DEFAULT NULL::character varying,
    user_img_profile character varying(1) DEFAULT NULL::character varying,
    user_name character varying(1) DEFAULT NULL::character varying,
    user_email character varying(1) DEFAULT NULL::character varying,
    user_password character varying(1) DEFAULT NULL::character varying,
    user_session_id character varying(1) DEFAULT NULL::character varying,
    user_permissions character varying(1) DEFAULT NULL::character varying,
    user_role_id character varying(1) DEFAULT NULL::character varying,
    user_clinic_id character varying(1) DEFAULT NULL::character varying,
    user_cpf character varying(1) DEFAULT NULL::character varying,
    user_rg character varying(1) DEFAULT NULL::character varying,
    user_birth character varying(1) DEFAULT NULL::character varying,
    user_gen character varying(1) DEFAULT NULL::character varying,
    user_civil_status character varying(1) DEFAULT NULL::character varying,
    user_home_phone character varying(1) DEFAULT NULL::character varying,
    user_cel_phone character varying(1) DEFAULT NULL::character varying,
    user_father_name character varying(1) DEFAULT NULL::character varying,
    user_mother_name character varying(1) DEFAULT NULL::character varying,
    user_address character varying(1) DEFAULT NULL::character varying,
    user_district character varying(1) DEFAULT NULL::character varying,
    user_city character varying(1) DEFAULT NULL::character varying,
    user_state character varying(1) DEFAULT NULL::character varying,
    user_cep character varying(1) DEFAULT NULL::character varying,
    user_func_pri character varying(1) DEFAULT NULL::character varying,
    user_func_sec character varying(1) DEFAULT NULL::character varying,
    user_date_adm character varying(1) DEFAULT NULL::character varying,
    user_date_dem character varying(1) DEFAULT NULL::character varying,
    user_active character varying(1) DEFAULT NULL::character varying,
    user_esp1 character varying(1) DEFAULT NULL::character varying,
    user_esp2 character varying(1) DEFAULT NULL::character varying,
    user_esp3 character varying(1) DEFAULT NULL::character varying,
    user_cro character varying(1) DEFAULT NULL::character varying,
    user_dom1 character varying(1) DEFAULT NULL::character varying,
    user_dom2 character varying(1) DEFAULT NULL::character varying,
    user_seg1 character varying(1) DEFAULT NULL::character varying,
    user_seg2 character varying(1) DEFAULT NULL::character varying,
    user_ter1 character varying(1) DEFAULT NULL::character varying,
    user_ter2 character varying(1) DEFAULT NULL::character varying,
    user_qua1 character varying(1) DEFAULT NULL::character varying,
    user_qua2 character varying(1) DEFAULT NULL::character varying,
    user_qui1 character varying(1) DEFAULT NULL::character varying,
    user_qui2 character varying(1) DEFAULT NULL::character varying,
    user_sex1 character varying(1) DEFAULT NULL::character varying,
    user_sex2 character varying(1) DEFAULT NULL::character varying,
    user_sab1 character varying(1) DEFAULT NULL::character varying,
    user_sab2 character varying(1) DEFAULT NULL::character varying
);


ALTER TABLE public._users OWNER TO rebasedata;

--
-- Name: _users_civil_status; Type: TABLE; Schema: public; Owner: rebasedata
--

CREATE TABLE public._users_civil_status (
    tipo_unitario_id character varying(1) DEFAULT NULL::character varying,
    tipo_unitario character varying(1) DEFAULT NULL::character varying
);


ALTER TABLE public._users_civil_status OWNER TO rebasedata;

--
-- Name: _users_esp; Type: TABLE; Schema: public; Owner: rebasedata
--

CREATE TABLE public._users_esp (
    esp_id character varying(1) DEFAULT NULL::character varying,
    esp character varying(1) DEFAULT NULL::character varying
);


ALTER TABLE public._users_esp OWNER TO rebasedata;

--
-- Name: _users_permissions; Type: TABLE; Schema: public; Owner: rebasedata
--

CREATE TABLE public._users_permissions (
    permissions_id character varying(1) DEFAULT NULL::character varying,
    permissions character varying(1) DEFAULT NULL::character varying
);


ALTER TABLE public._users_permissions OWNER TO rebasedata;

--
-- Data for Name: _bills_to_receive; Type: TABLE DATA; Schema: public; Owner: rebasedata
--

COPY public._bills_to_receive (receive_id, receive_venc, receive_date_pay, receive_cat, receive_desc, receive_val, receive_created, receive_modified, receive_status) FROM stdin;
\.


--
-- Data for Name: _calendar; Type: TABLE DATA; Schema: public; Owner: rebasedata
--

COPY public._calendar (calendar_id, calendar_start, calendar_end, calendar_start_normal, calendar_end_normal, calendar_class, calendar_proc, calendar_pat, calendar_desc) FROM stdin;
\.


--
-- Data for Name: _cash_flow; Type: TABLE DATA; Schema: public; Owner: rebasedata
--

COPY public._cash_flow (flow_id, flow_venc, flow_date_pay, flow_cat, flow_desc, flow_val, flow_created, flow_modified, flow_status) FROM stdin;
\.


--
-- Data for Name: _checks; Type: TABLE DATA; Schema: public; Owner: rebasedata
--

COPY public._checks (checks_id, checks_holder, checks_val, checks_cod, checks_bank, checks_agency, checks_date, checks_received, checks_forwarded, checks_created, checks_modified) FROM stdin;
\.


--
-- Data for Name: _company; Type: TABLE DATA; Schema: public; Owner: rebasedata
--

COPY public._company (company_id, company_name) FROM stdin;
\.


--
-- Data for Name: _covenant; Type: TABLE DATA; Schema: public; Owner: rebasedata
--

COPY public._covenant (covenant_id, covenant_name, covenant_cpf_cnpj, covenant_rs, covenant_at, covenant_end, covenant_district, covenant_city, covenant_uf, covenant_cep, covenant_nation, covenant_cel, covenant_tel_1, covenant_tel_2, covenant_insc_uf, covenant_web_url, covenant_sit, covenant_email, covenant_rep_name, covenant_rep_nick, covenant_rep_cel, covenant_rep_tel_1, covenant_rep_tel_2, covenant_rep_email, covenant_banco_1, covenant_agencia_1, covenant_conta_1, covenant_titular_1, covenant_banco_2, covenant_agencia_2, covenant_conta_2, covenant_titular_2, covenant_obs, covenant_created, covenant_modified) FROM stdin;
\.


--
-- Data for Name: _fees; Type: TABLE DATA; Schema: public; Owner: rebasedata
--

COPY public._fees (fees_id, covenant_id, fees_cod, fees_proc, fees_cat, fees_val_real, fees_desc, fees_val_final, fees_obs, fees_created, fees_modified) FROM stdin;
\.


--
-- Data for Name: _laboratory; Type: TABLE DATA; Schema: public; Owner: rebasedata
--

COPY public._laboratory (laboratory_id, laboratory_name, laboratory_cpf_cnpj, laboratory_rs, laboratory_at, laboratory_end, laboratory_district, laboratory_city, laboratory_cep, laboratory_uf, laboratory_nation, laboratory_cel, laboratory_tel_1, laboratory_tel_2, laboratory_insc_uf, laboratory_email, laboratory_web_url, laboratory_sit, laboratory_conta_2, laboratory_rep_nome, laboratory_rep_apelido, laboratory_rep_email, laboratory_rep_cel, laboratory_rep_tel_1, laboratory_rep_tel_2, laboratory_banco_1, laboratory_agencia_1, laboratory_conta_1, laboratory_titular_1, laboratory_banco_2, laboratory_agencia_2, laboratory_titular_2, laboratory_obs, laboratory_created, laboratory_modified) FROM stdin;
\.


--
-- Data for Name: _login_attempts; Type: TABLE DATA; Schema: public; Owner: rebasedata
--

COPY public._login_attempts (login_attempts_id, login_attempts_users_id, created_at) FROM stdin;
\.


--
-- Data for Name: _patrimony; Type: TABLE DATA; Schema: public; Owner: rebasedata
--

COPY public._patrimony (patrimony_id, patrimony_cod, patrimony_desc, patrimony_data_aq, patrimony_cor, patrimony_for, patrimony_dimen, patrimony_setor, patrimony_valor, patrimony_garan, patrimony_quant, patrimony_nf, patrimony_sit, patrimony_obs, patrimony_created, patrimony_modified) FROM stdin;
\.


--
-- Data for Name: _payments; Type: TABLE DATA; Schema: public; Owner: rebasedata
--

COPY public._payments (payments_id, payments_venc, payments_date_pay, payments_cat, payments_desc, payments_val, payments_created, payments_modified, payments_status) FROM stdin;
\.


--
-- Data for Name: _providers; Type: TABLE DATA; Schema: public; Owner: rebasedata
--

COPY public._providers (provider_id, provider_name, provider_cpf_cnpj, provider_rs, provider_at, provider_end, provider_district, provider_city, provider_uf, provider_cep, provider_nation, provider_cel, provider_tel_1, provider_tel_2, provider_insc_uf, provider_web_url, provider_sit, provider_email, provider_rep_name, provider_rep_apelido, provider_rep_cel, provider_rep_tel_1, provider_rep_tel_2, provider_rep_email, provider_banco_1, provider_agencia_1, provider_conta_1, provider_titular_1, provider_banco_2, provider_agencia_2, provider_conta_2, provider_titular_2, provider_obs, provider_created, provider_modified) FROM stdin;
\.


--
-- Data for Name: _query_data; Type: TABLE DATA; Schema: public; Owner: rebasedata
--

COPY public._query_data (id, name, "timestamp", querycount) FROM stdin;
\.


--
-- Data for Name: _recoveries; Type: TABLE DATA; Schema: public; Owner: rebasedata
--

COPY public._recoveries (recovery_id, recovery_users_id, recovery_token, recovery_status) FROM stdin;
\.


--
-- Data for Name: _roles; Type: TABLE DATA; Schema: public; Owner: rebasedata
--

COPY public._roles (role_id, role_level) FROM stdin;
\.


--
-- Data for Name: _stock; Type: TABLE DATA; Schema: public; Owner: rebasedata
--

COPY public._stock (stock_id, stock_cod, stock_desc, stock_tipo_unit, stock_forn, stock_inicial, stock_minimo, stock_atual, stock_prec, stock_obs, stock_created, stock_modified) FROM stdin;
\.


--
-- Data for Name: _stock_tipo_unitario; Type: TABLE DATA; Schema: public; Owner: rebasedata
--

COPY public._stock_tipo_unitario (tipo_unitario_id, tipo_unitario) FROM stdin;
\.


--
-- Data for Name: _users; Type: TABLE DATA; Schema: public; Owner: rebasedata
--

COPY public._users (user_id, user_img_profile, user_name, user_email, user_password, user_session_id, user_permissions, user_role_id, user_clinic_id, user_cpf, user_rg, user_birth, user_gen, user_civil_status, user_home_phone, user_cel_phone, user_father_name, user_mother_name, user_address, user_district, user_city, user_state, user_cep, user_func_pri, user_func_sec, user_date_adm, user_date_dem, user_active, user_esp1, user_esp2, user_esp3, user_cro, user_dom1, user_dom2, user_seg1, user_seg2, user_ter1, user_ter2, user_qua1, user_qua2, user_qui1, user_qui2, user_sex1, user_sex2, user_sab1, user_sab2) FROM stdin;
\.


--
-- Data for Name: _users_civil_status; Type: TABLE DATA; Schema: public; Owner: rebasedata
--

COPY public._users_civil_status (tipo_unitario_id, tipo_unitario) FROM stdin;
\.


--
-- Data for Name: _users_esp; Type: TABLE DATA; Schema: public; Owner: rebasedata
--

COPY public._users_esp (esp_id, esp) FROM stdin;
\.


--
-- Data for Name: _users_permissions; Type: TABLE DATA; Schema: public; Owner: rebasedata
--

COPY public._users_permissions (permissions_id, permissions) FROM stdin;
\.


--
-- PostgreSQL database dump complete
--

