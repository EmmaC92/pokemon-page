CREATE DATABASE IF NOT EXISTS pokemon_ico;

CREATE TABLE IF NOT EXISTS pokemon_ico.pokemon_match (
    id bigint(20) unsigned NOT NULL,
    first_pokemon varchar(20) NOT NULL,
    second_pokemon varchar(20) NOT NULL,
    who_won varchar(6) NOT NULL,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    primary key (id)
);