DATA
Currently I'm working with 5 tables: (abilities, ability_hero, heroes, relationship_types, relationships)

    - ability_heroes
        - hero_id relates to -> id in heroes table
        - ability_id relates -> to id in ability table
    - relationships
        - hero1/2_id relates to -> id in heroes table
        - type_id relates to -> id in relationship_types table
    
