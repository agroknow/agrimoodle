<?php

/**
 * This function serves a collection of localization strings for the dialog.
 *
 */
#if (! defined('MOODLE_INTERNAL')) die;
# NOTE: For the time being, this file is parsed from the module.js script!
#function block_mdeditor_L10n() {
/* Most (if not all) of these strings are localized before sent to the
 * client. */

$L10n = array(
    'dialog' => array(
        'caption' => 'LOM Editor',
        'translateCaption' => 'Translate LOM elements',
        'template' => 'Use details from existing LOM record',
        'copy_button' => 'Copy',
        'copy_from_course' => 'C O U R S E'
    ),
    'category' => array(
        'general' => '1. General',
        'life_cycle' => "2. Life Cycle",
        'meta_metadata' => "3. Meta-Metadata",
        'educational' => '4. Educational',
        'rights' => '5. Rights',
        'classification' => '6. Classification',
        'selectelanguage' => 'Select languages'
    ),
    'element' => array(
        'title' => array(
            'caption' => 'Title'
        ),
        'subTitle' => array(
            'caption' => 'Subtitle'
        ),
        'language13' => array(
            'caption' => 'Primary language(s)',
            'seachtext' => 'Type here to search list',
            'options' => null
        ),
        'description' => array(
            'caption' => 'Description',
            'cardinality_add' => 'Add another description',
            'cardinality_hide' => 'Ignore this description'
        ),
        'keyword' => array(
            'caption' => 'Keyword',
            'cardinality_add' => 'Add another keword',
            'cardinality_hide' => 'Ignore this keyword'
        ),
        'contribute2' => array(
            'caption' => 'Contribution',
//                'cardinality_add' => "Add another contribution role",
            'cardinality_add' => "Add contributor...",
            'cardinality_hide' => 'Remove this contributor',
            'role' => array(
                'caption' => 'Role: ',
                'options' => array(
                    "" => "Choose role...",
                    "author" => "Author",
                    "publisher" => "Publisher",
                    "unknown" => "Unknown",
                    "initiator" => "Initiator",
                    "terminator" => "Terminator",
                    "validator" => "Validator",
                    "editor" => "Editor",
                    "graphical_designer" => "Graphical designer",
                    "technical_implementer" => "Technical implementer",
                    "content_provider" => "Content provider",
                    "technical_validator" => "Technical validator",
                    "educational_validator" => "Educational validator",
                    "script_writer" => "Script writer",
                    "instrucational_designer" => "Insructional designer",
                    "subject_matter_expert" => "Subject matter expert",
                )
            ),
            'date' => array(
                'caption' => 'Date:',
                'placeholder' => 'Date (e.g. 12/25/2010, 1995, etc.)'
            ),
            'entities' => array(
                'caption' => 'People',
                'firstname' => 'Firstname',
                'lastname' => 'Lastname',
                'email' => 'E-mail',
                'organization' => 'Organization',
            )
        ),
        'language34' => array(
            'caption' => 'Language: ',
            'options' => array(
                '' => 'Choose language...'
            )
        ),
        'contribute3' => array(
            'caption' => 'Contribute',
//                'cardinality_add' => "Add another contribution role",
            'cardinality_add' => "Add contributor...",
            'cardinality_hide' => 'Remove this contributor',
            'role' => array(
                'caption' => 'Role: ',
                'options' => array(
                    "" => "Choose role...",
                    "creator" => "Creator",
                    "enricher" => "Enricher",
                    "provider" => "Provider",
                    "validator" => "Validator"
                )
            ),
            'date' => array(
                'caption' => 'Date:',
                'placeholder' => 'Date (e.g. 25/12/2010, 1995, etc.)'
            ),
            'entities' => array(
                'caption' => 'People',
                'firstname' => 'Firstname',
                'lastname' => 'Lastname',
                'email' => 'E-mail',
                'organization' => 'Organization',
            )
        )
    ),
    'common' => array(
        'langString_add' => 'Add another translation',
        'langString_hide' => 'Hide this translation',
    ),
    'message' => array(
        'save_success' => 'The metadata have been saved',
        'course_status_caption' => 'Status: ',
        'course_status_complete' => 'Mandatory fields completed.',
        'course_status_partial' => 'Partially completed.',
        'course_status_not_started' => 'No record found.',
        'pending_response' => 'Pending reponse',
    ),
    'error' => array(
        'form_has_errors' => 'There are errors in the form',
        'required_non-empty' => 'Must fill in',
        'required_at-least-one' => 'Choose at least one',
        'required_exactly-one' => 'Choose one',
        'error_occurred' => 'An error has occured',
    )
);


/*
 * TAXONOMY
 * --------
 * Comments on
 * details
 * explains
 * methodology
 * provides alternative view on
 * provides background on
 * provides data on
 * provides examples of
 * provides new information on
 * provides theoretical information on
 * refutes
 * summarizes
 * supports
 */


/* ------------------[ not implemented yed ]------------------------ */

$L10n['element']['classification_details']['caption'] = 'Details…';
$L10n['element']['classification_details']['options'] = array(
    'Activity' => array(
        'type' => 'optgroup',
        'label' => 'Activity',
        'options' => array(
            "food_activity" => "food activity",
            "animal_production_activity" => "&nbsp;&nbsp;&nbsp;&nbsp;animal production activity",
            "animal_husbandry" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;animal husbandry",
            "apiculture" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;apiculture",
            "aquaculture" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;aquaculture",
            "breeding" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;breeding",
            "dairy_production" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dairy production",
            "disease_control" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;disease control",
            "disease_prevention" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;disease prevention",
            "disease_treatment" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;disease treatment",
            "egg_production" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;egg production",
            "feather_production" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;feather production",
            "feeding" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;feeding",
            "fodder_management" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fodder management",
            "livestock_housing" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;livestock housing",
            "meat_production" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;meat production",
            "milk_production" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;milk production",
            "plant_production_activity" => "&nbsp;&nbsp;&nbsp;&nbsp;plant production activity",
            "crop_rotation" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;crop rotation",
            "cultivation_of_cereals" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;cultivation of cereals",
            "energy_crops_cultivation" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;energy crops cultivation",
            "fertilizing" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fertilizing",
            "field_crops_cultivation" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;field crops cultivation",
            "floriculture" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;floriculture",
            "fruit_production" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fruit production",
            "gardening" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;gardening",
            "herb_cultivation" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;herb cultivation",
            "horticulture" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;horticulture",
            "multicropping" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;multicropping",
            "pest_control" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pest control",
            "plowing" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;plowing",
            "post_harvest" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;post harvest",
            "sowing" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sowing",
            "tillage" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;tillage",
            "viticulture" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;viticulture",
            "processing_activity" => "&nbsp;&nbsp;&nbsp;&nbsp;processing activity",
            "animal_feed_processing" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;animal feed processing",
            "dairy_processing" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dairy processing",
            "food_processing" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;food processing",
            "meat_processing" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;meat processing",
            "non_production_activity" => "non production activity",
            "educational_activity" => "&nbsp;&nbsp;&nbsp;&nbsp;educational activity",
            "green_care" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;green care",
            "learning" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;learning",
            "research" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;research",
            "teaching" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;teaching",
            "training" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;training",
            "service_oriented_activity" => "&nbsp;&nbsp;&nbsp;&nbsp;service oriented activity",
            "community_service" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;community service",
            "ecotourism" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ecotourism",
        ),
    ),
    'Entity' => array(
        'type' => 'optgroup',
        'label' => 'Entity',
        'options' => array(
            "natural_person" => "natural person",
            "consumer" => "&nbsp;&nbsp;&nbsp;&nbsp;consumer",
            "distributor" => "&nbsp;&nbsp;&nbsp;&nbsp;distributor",
            "farmer" => "&nbsp;&nbsp;&nbsp;&nbsp;farmer",
            "land_owner" => "&nbsp;&nbsp;&nbsp;&nbsp;land owner",
            "learner" => "&nbsp;&nbsp;&nbsp;&nbsp;learner",
            "processor" => "&nbsp;&nbsp;&nbsp;&nbsp;processor",
            "teacher" => "&nbsp;&nbsp;&nbsp;&nbsp;teacher",
            "trader" => "&nbsp;&nbsp;&nbsp;&nbsp;trader",
            "juridical_entity" => "juridical entity",
            "certification_agency" => "&nbsp;&nbsp;&nbsp;&nbsp;certification agency",
            "commercial_enterprise" => "&nbsp;&nbsp;&nbsp;&nbsp;commercial enterprise",
            "educational_establishment" => "&nbsp;&nbsp;&nbsp;&nbsp;educational establishment",
            "farm" => "&nbsp;&nbsp;&nbsp;&nbsp;farm",
            "government_body" => "&nbsp;&nbsp;&nbsp;&nbsp;government body",
        ),
    ),
    'Issue' => array(
        'type' => 'optgroup',
        'label' => 'Issue',
        'options' => array(
            "consumption_issue" => "consumption issue",
            "consumer_attitudes" => "&nbsp;&nbsp;&nbsp;&nbsp;consumer attitudes",
            "consumer_knowledge" => "&nbsp;&nbsp;&nbsp;&nbsp;consumer knowledge",
            "quality_perception" => "&nbsp;&nbsp;&nbsp;&nbsp;quality perception",
            "traceability" => "&nbsp;&nbsp;&nbsp;&nbsp;traceability",
            "distribution_issue" => "distribution issue",
            "alternative_distribution" => "&nbsp;&nbsp;&nbsp;&nbsp;alternative distribution",
            "farm_sale" => "&nbsp;&nbsp;&nbsp;&nbsp;farm sale",
            "food_shed" => "&nbsp;&nbsp;&nbsp;&nbsp;food shed",
            "import-export_issue" => "&nbsp;&nbsp;&nbsp;&nbsp;import-export issue",
            "local_market" => "&nbsp;&nbsp;&nbsp;&nbsp;local market",
            "market" => "&nbsp;&nbsp;&nbsp;&nbsp;market",
            "traceability" => "&nbsp;&nbsp;&nbsp;&nbsp;traceability",
            "environmental_issue" => "environmental issue",
            "biodiversity" => "&nbsp;&nbsp;&nbsp;&nbsp;biodiversity",
            "climate_change_mitigation" => "&nbsp;&nbsp;&nbsp;&nbsp;climate change mitigation",
            "cultural_landscapes" => "&nbsp;&nbsp;&nbsp;&nbsp;cultural landscapes",
            "ecological_footprint" => "&nbsp;&nbsp;&nbsp;&nbsp;ecological footprint",
            "energy_efficiency" => "&nbsp;&nbsp;&nbsp;&nbsp;energy efficiency",
            "environmental_impact" => "&nbsp;&nbsp;&nbsp;&nbsp;environmental impact",
            "pollution" => "&nbsp;&nbsp;&nbsp;&nbsp;pollution",
            "recycling" => "&nbsp;&nbsp;&nbsp;&nbsp;recycling",
            "renewable_resources" => "&nbsp;&nbsp;&nbsp;&nbsp;renewable resources",
            "sustainability" => "&nbsp;&nbsp;&nbsp;&nbsp;sustainability",
            "water_quality" => "&nbsp;&nbsp;&nbsp;&nbsp;water quality",
            "ethical_issue" => "ethical issue",
            "poverty_alleviation" => "&nbsp;&nbsp;&nbsp;&nbsp;poverty alleviation",
            "rural_livelihoods" => "&nbsp;&nbsp;&nbsp;&nbsp;rural livelihoods",
            "sustainability" => "&nbsp;&nbsp;&nbsp;&nbsp;sustainability",
            "food_issue" => "food issue",
            "food_availability" => "&nbsp;&nbsp;&nbsp;&nbsp;food availability",
            "food_nutrition" => "&nbsp;&nbsp;&nbsp;&nbsp;food nutrition",
            "food_quality" => "&nbsp;&nbsp;&nbsp;&nbsp;food quality",
            "food_safety" => "&nbsp;&nbsp;&nbsp;&nbsp;food safety",
            "food_security" => "&nbsp;&nbsp;&nbsp;&nbsp;food security",
            "food_sufficiency" => "&nbsp;&nbsp;&nbsp;&nbsp;food sufficiency",
            "food_system" => "&nbsp;&nbsp;&nbsp;&nbsp;food system",
            "natural_food" => "&nbsp;&nbsp;&nbsp;&nbsp;natural food",
            "poverty_alleviation" => "&nbsp;&nbsp;&nbsp;&nbsp;poverty alleviation",
            "health_issue" => "health issue",
            "animal_health" => "&nbsp;&nbsp;&nbsp;&nbsp;animal health",
            "human_health" => "&nbsp;&nbsp;&nbsp;&nbsp;human health",
            "plant_health" => "&nbsp;&nbsp;&nbsp;&nbsp;plant health",
            "well_being" => "&nbsp;&nbsp;&nbsp;&nbsp;well being",
            "learning_issue" => "learning issue",
            "action_learning" => "&nbsp;&nbsp;&nbsp;&nbsp;action learning",
            "action_research" => "&nbsp;&nbsp;&nbsp;&nbsp;action research",
            "school_garden" => "&nbsp;&nbsp;&nbsp;&nbsp;school garden",
            "marketing_issue" => "marketing issue",
            "direct_marketing" => "&nbsp;&nbsp;&nbsp;&nbsp;direct marketing",
            "market_trend" => "&nbsp;&nbsp;&nbsp;&nbsp;market trend",
            "processing_issue" => "processing issue",
            "post_harvest_handling" => "&nbsp;&nbsp;&nbsp;&nbsp;post harvest handling",
            "pre_cooling" => "&nbsp;&nbsp;&nbsp;&nbsp;pre cooling",
            "pre_storage" => "&nbsp;&nbsp;&nbsp;&nbsp;pre storage",
            "storage" => "&nbsp;&nbsp;&nbsp;&nbsp;storage",
            "benefits_of_organic_agriculture" => "benefits of organic agriculture",
            "benefits_of_organic_agriculture" => "&nbsp;&nbsp;&nbsp;&nbsp;benefits of organic agriculture",
            "organic-conventional_agriculture_comparison" => "&nbsp;&nbsp;&nbsp;&nbsp;organic-conventional agriculture comparison",
            "organic_principle" => "&nbsp;&nbsp;&nbsp;&nbsp;organic principle",
            "production_issue" => "production issue",
            "genetically_modified_organism" => "&nbsp;&nbsp;&nbsp;&nbsp;genetically modified organism",
            "local_production" => "&nbsp;&nbsp;&nbsp;&nbsp;local production",
            "local_resources" => "&nbsp;&nbsp;&nbsp;&nbsp;local resources",
            "product_origin" => "&nbsp;&nbsp;&nbsp;&nbsp;product origin",
            "rural_livelihoods" => "&nbsp;&nbsp;&nbsp;&nbsp;rural livelihoods",
            "animal_production_issue" => "&nbsp;&nbsp;&nbsp;&nbsp;animal production issue",
            "animal_behavior" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;animal behavior",
            "animal_diet" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;animal diet",
            "animal_ethics" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;animal ethics",
            "animal_nutrition" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;animal nutrition",
            "animal_welfare" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;animal welfare",
            "housing" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;housing",
            "local_breeds" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;local breeds",
            "outdoor_keeping" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;outdoor keeping",
            "plant_production_issue" => "&nbsp;&nbsp;&nbsp;&nbsp;plant production issue",
            "alternative_crop" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;alternative crop",
            "crop_ecology" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;crop ecology",
            "diversity" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;diversity",
            "genetic_resistance" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;genetic resistance",
            "plant_nutrition" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;plant nutrition",
            "plant_protection" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;plant protection",
            "soil_issue" => "soil issue",
            "diminution_of_humus" => "&nbsp;&nbsp;&nbsp;&nbsp;diminution of humus",
            "humus" => "&nbsp;&nbsp;&nbsp;&nbsp;humus",
            "nitrogen_fixation" => "&nbsp;&nbsp;&nbsp;&nbsp;nitrogen fixation",
            "nutrient_deficiency" => "&nbsp;&nbsp;&nbsp;&nbsp;nutrient deficiency",
            "nutrient_recycling" => "&nbsp;&nbsp;&nbsp;&nbsp;nutrient recycling",
            "organic_matter" => "&nbsp;&nbsp;&nbsp;&nbsp;organic matter",
            "soil_acidification" => "&nbsp;&nbsp;&nbsp;&nbsp;soil acidification",
            "soil_biological_activity" => "&nbsp;&nbsp;&nbsp;&nbsp;soil biological activity",
            "soil_compaction" => "&nbsp;&nbsp;&nbsp;&nbsp;soil compaction",
            "soil_conservation" => "&nbsp;&nbsp;&nbsp;&nbsp;soil conservation",
            "soil_degradation" => "&nbsp;&nbsp;&nbsp;&nbsp;soil degradation",
            "soil_erosion" => "&nbsp;&nbsp;&nbsp;&nbsp;soil erosion",
            "soil_fertility" => "&nbsp;&nbsp;&nbsp;&nbsp;soil fertility",
            "soil_health" => "&nbsp;&nbsp;&nbsp;&nbsp;soil health",
            "soil_husbandry" => "&nbsp;&nbsp;&nbsp;&nbsp;soil husbandry",
            "soil_structure" => "&nbsp;&nbsp;&nbsp;&nbsp;soil structure",
            "transport_issue" => "transport issue",
            "transport_of_animals" => "&nbsp;&nbsp;&nbsp;&nbsp;transport of animals",
            "transport_of_products" => "&nbsp;&nbsp;&nbsp;&nbsp;transport of products",
            "waste_management_issue" => "waste management issue",
            "biosolids" => "&nbsp;&nbsp;&nbsp;&nbsp;biosolids",
            "recycling" => "&nbsp;&nbsp;&nbsp;&nbsp;recycling",
            "slaughter_house_waste" => "&nbsp;&nbsp;&nbsp;&nbsp;slaughter house waste",
        ),
    ),
    'Method' => array(
        'type' => 'optgroup',
        'label' => 'Method',
        'options' => array(
            "agricultural_method" => "agricultural method",
            "alternative_farming" => "&nbsp;&nbsp;&nbsp;&nbsp;alternative farming",
            "companion_planting" => "&nbsp;&nbsp;&nbsp;&nbsp;companion planting",
            "extensive_farming" => "&nbsp;&nbsp;&nbsp;&nbsp;extensive farming",
            "intensive_farming" => "&nbsp;&nbsp;&nbsp;&nbsp;intensive farming",
            "intercropping" => "&nbsp;&nbsp;&nbsp;&nbsp;intercropping",
            "monoculture" => "&nbsp;&nbsp;&nbsp;&nbsp;monoculture",
            "pasture_management" => "&nbsp;&nbsp;&nbsp;&nbsp;pasture management",
            "permaculture" => "&nbsp;&nbsp;&nbsp;&nbsp;permaculture",
            "polyculture" => "&nbsp;&nbsp;&nbsp;&nbsp;polyculture",
            "soiless_culture" => "&nbsp;&nbsp;&nbsp;&nbsp;soiless culture",
            "subsistence_farming" => "&nbsp;&nbsp;&nbsp;&nbsp;subsistence farming",
            "sustainable_farming" => "&nbsp;&nbsp;&nbsp;&nbsp;sustainable farming",
            "pest_control_technique" => "pest control technique",
            "biological_pest_control" => "&nbsp;&nbsp;&nbsp;&nbsp;biological pest control",
            "chemical_pest_control" => "&nbsp;&nbsp;&nbsp;&nbsp;chemical pest control",
            "direct_pest_control" => "&nbsp;&nbsp;&nbsp;&nbsp;direct pest control",
            "preventive_pest_control" => "&nbsp;&nbsp;&nbsp;&nbsp;preventive pest control",
            "weed_control" => "&nbsp;&nbsp;&nbsp;&nbsp;weed control",
            "weed_control_technique" => "&nbsp;&nbsp;&nbsp;&nbsp;weed control technique",
        ),
    ),
    'Policy' => array(
        'type' => 'optgroup',
        'label' => 'Policy',
        'options' => array(
            "regulation" => "regulation",
            "certification" => "&nbsp;&nbsp;&nbsp;&nbsp;certification",
            "certification_of_organic_agriculture" => "&nbsp;&nbsp;&nbsp;&nbsp;certification of organic agriculture",
            "labeling" => "&nbsp;&nbsp;&nbsp;&nbsp;labeling",
            "legislation" => "&nbsp;&nbsp;&nbsp;&nbsp;legislation",
            "legislation_on_organic_agriculture" => "&nbsp;&nbsp;&nbsp;&nbsp;legislation on organic agriculture",
            "standard" => "standard",
            "organic_standard" => "&nbsp;&nbsp;&nbsp;&nbsp;organic standard",
        ),
    ),
    'Process' => array(
        'type' => 'optgroup',
        'label' => 'Process',
        'options' => array(
            "accreditation" => "accreditation",
            "certification_process" => "certification process",
            "organic_conversion" => "organic conversion",
            "recycling" => "recycling",
        )
    ),
    'Product' => array(
        'type' => 'optgroup',
        'label' => 'Product',
        'options' => array(
            "animal_origin_product" => "animal origin product",
            "animal_origin_processed_product" => "&nbsp;&nbsp;&nbsp;&nbsp;animal origin processed product",
            "dairy_product" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dairy product",
            "leather" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;leather",
            "meat_product" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;meat product",
            "animal_origin_unprocessed_product" => "&nbsp;&nbsp;&nbsp;&nbsp;animal origin unprocessed product",
            "egg" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;egg",
            "feather" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;feather",
            "fish" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fish",
            "honey" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;honey",
            "meat" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;meat",
            "milk" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;milk",
            "shellfish" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;shellfish",
            "wool" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;wool",
            "fertilizer" => "fertilizer",
            "biological_fertilizer" => "&nbsp;&nbsp;&nbsp;&nbsp;biological fertilizer",
            "manure-animal" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;manure-animal",
            "compost" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;compost",
            "green_manure" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;green manure",
            "manure" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;manure",
            "peat" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;peat",
            "commercial_biological_fertilizer" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;commercial biological fertilizer",
            "bone_meal" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;bone meal",
            "meal_fertilizer" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;meal fertilizer",
            "pellets" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pellets",
            "chemical_compound" => "&nbsp;&nbsp;&nbsp;&nbsp;chemical compound",
            "nitrogen" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;nitrogen",
            "phosphorus" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;phosphorus",
            "potassium" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;potassium",
            "salt" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;salt",
            "urea" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;urea",
            "mineral_fertilizer" => "&nbsp;&nbsp;&nbsp;&nbsp;mineral fertilizer",
            "plant_origin_unprocessed_product" => "plant origin unprocessed product",
            "crop_residue" => "&nbsp;&nbsp;&nbsp;&nbsp;crop residue",
            "plant_origin_processed_product" => "&nbsp;&nbsp;&nbsp;&nbsp;plant origin processed product",
            "beer" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;beer",
            "fodder" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fodder",
            "olive_oil" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;olive oil",
            "wine" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;wine",
            "plant_origin_unprocessed_product" => "&nbsp;&nbsp;&nbsp;&nbsp;plant origin unprocessed product",
            "energy_crop" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;energy crop",
            "rape" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;rape",
            "sugar_beet" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sugar beet",
            "feed_crop" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;feed crop",
            "alfalfa" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;alfalfa",
            "clover" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;clover",
            "festuca" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;festuca",
            "ryegrass" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ryegrass",
            "vetch" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;vetch",
            "grass" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;grass",
            "pulse" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pulse",
            "fibre_crop" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fibre crop",
            "cotton" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;cotton",
            "fiber_flax" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fiber flax",
            "hemp" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;hemp",
            "food_crop" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;food crop",
            "berry" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;berry",
            "cereal" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;cereal",
            "barley" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;barley",
            "bread_cereal" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;bread cereal",
            "fodder_cereal" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fodder cereal",
            "maize" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;maize",
            "pseudocereal" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pseudocereal",
            "rice" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;rice",
            "rye" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;rye",
            "spelt" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;spelt",
            "wheat" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;wheat",
            "fruit" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fruit",
            "apple" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;apple",
            "citrus_species" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;citrus species",
            "herb" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;herb",
            "oil_crop" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;oil crop",
            "olive" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;olive",
            "rape" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;rape",
            "soybean" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;soybean",
            "sunflower" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sunflower",
            "pulse" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pulse",
            "beans" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;beans",
            "lentil" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;lentil",
            "pea" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pea",
            "vetch" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;vetch",
            "vegetable" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;vegetable",
            "potato" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;potato"
        ),
    ),
);


$L10n['common']['languages'] = array(
//        'af' => 'Afrikaans',
//        'gsw' => 'Alemannic',
//        'bs' => 'Bosnian',
    'en' => 'English',
    'el' => 'Greek',
    'fr' => 'French',
    'de' => 'German',
    'es' => 'Spanish',
    'nl' => 'Dutch',
    'sv' => 'Swedish',
    'ru' => 'Russian',
    'it' => 'Italian',
    'lv' => 'Latvian',
    'da' => 'Danish',
    'no' => 'Norwegian',
    'ee' => 'Estonian',
    'lt' => 'Lithuanian',
    'cs' => 'Czech',
    'pl' => 'Polish',
    'hu' => 'Hungarian',
    'bg' => 'Bulgarian',
    'tr' => 'Turkish',
    'he' => 'Hebrew',
    'hi' => 'Hindi',
    'zh' => 'Chinese',
    'ja' => 'Japanese',
    'eo' => 'Esperanto',
//        'ht' => 'Haitian; Haitian Creole',
//        'ga' => 'Irish',
//        'is' => 'Icelandic',
//        'ko' => 'Korean',
//        'nn' => 'Norwegian Nynorsk',
);

$L10n['common']['languages_count'] = count($L10n['common']['languages']);



$L10n['element']['rights'] = array(
    'cardinality_add' => "Add additional rights",
    'cardinality_hide' => "Ignore these rights",
    'cost' => array(
        'caption' => 'Cost: '
    ),
    'cc_caption' => 'License that applies to the resource (according to Creative Commons)',
    'cc_options' => array(
        /* CAUTION! DO NOT CHANGE THE KEYS HERE! */
        '' => 'none',
        'by' => 'The owner ALLOWS commercial uses AND changes to the resource<br/>(<a target="_blank" href="http://creativecommons.org/licenses/by/3.0/">Attribution 3.0 Unported</a>)',
        'by_nd' => 'The owner ALLOWS commercial uses but does NOT allow changes to the resource<br/>(<a target="_blank" href="http://creativecommons.org/licenses/by-nd/3.0/">Attribution-NoDerivs 3.0 Unported</a>)',
        'by_nc_nd' => 'The owner does NOT allow commercial uses OR changes to the resource<br/>(<a target="_blank" href="http://creativecommons.org/licenses/by-nc-nd/3.0/">Attribution-NonCommercial-NoDerivs 3.0 Unported</a>)',
        'by_nc' => 'Owner does NOT allow commercial uses but ALLOWS changes to the resource<br/>(<a target="_blank" href="http://creativecommons.org/licenses/by-nc/3.0/">Attribution-NonCommercial 3.0 Unported</a>)'
    ),
    'restrictions' => array(
        'caption' => 'Copyright and restrictions: '
    )
);

$L10n['element']['interactivity_type'] = array(
    'caption' => 'Interactivity type: ',
    'options' => array(
        '' => 'Choose...',
        'active' => 'active',
        'expositive' => 'expositive',
        'mixed' => 'mixed'
    )
);

// FIXME: note, that this element is ordered!!!
// we must find some way for the user to specify order...	
$L10n['element']['end_user_role'] = array(
    'caption' => 'End-user role: ',
    'options' => array(
        'author' => 'author',
        'counsellor' => 'counsellor',
        'learner' => 'learner',
        'manager' => 'manager',
        'parent' => 'parent',
        'teacher' => 'teacher',
        'other' => 'other'
    )
);



$L10n['element']['learning_context'] = array(
    'caption' => 'Learning context: ',
    'options' => array(
        'pre-school' => 'pre-school',
        'compulsory education' => 'compulsory education',
        'special education' => 'special education',
        'vocational education' => 'vocational education',
        'higher education' => 'higher education',
        'higher education gropu' => array(
            'type' => 'optgroup',
            'label' => '>>>',
            'options' => array(
                'post-graduate education' => 'post-graduate education',
                'pre-graduate education' => 'pre-graduate education'
            )
        ),
        'distance education' => 'distance education',
        'continuing education' => 'continuing education',
        'professional development' => 'professional development',
        'library' => 'library',
        'educational administration' => 'educational administration',
        'policy making' => 'policy making',
        'other' => 'other'
    )
);



$L10n['element']['resource_type'] = array(
    'caption' => 'Learning resource type',
    'options' => array(
        'application' => 'application',
        'assessment' => 'assessment',
        'broadcast' => 'broadcast',
        'case_study' => 'case study',
        'course' => 'course',
        'demonstration' => 'demonstration',
        'drill_and_practice' => 'drill and practice',
        'educational_game' => 'educational game',
        'enquiry-oriented activity' => 'enquiry-oriented activity',
        'experiment' => 'experiment',
        'exploration' => 'exploration',
        'glossary' => 'glossary',
        'guide' => 'guide',
        'learning asset' => array(
            'type' => 'optgroup',
            'label' => 'learning asset',
            'options' => array(
                'audio' => 'audio',
                'data' => 'data',
                'image' => 'image',
                'model' => 'model',
                'text' => 'text',
                'video' => 'video',
                'lesson_plan' => 'lesson plan',
                'open_activity' => 'open activity',
                'presentation' => 'presentation',
                'project' => 'project',
                'reference' => 'reference',
                'role_play' => 'role play',
                'simulation' => 'simulation',
                'tool' => 'tool'
            )
        ),
        'web resource' => array(
            'type' => 'optgroup',
            'label' => 'web resource',
            'options' => array(
                'weblog' => 'weblog',
                'web_page' => 'web page',
                'wiki' => 'wiki',
                'other_web_resource' => 'other web resource',
                'other' => 'other'
            )
        )
    )
);

$L10n['element']['interactivity_level'] = array(
    'caption' => 'Interactivity level: ',
    'options' => array(
        '' => 'Choose...',
        'very_low' => 'very low',
        'low' => 'low',
        'medium' => 'medium',
        'high' => 'high',
        'very_high' => 'very high',
    )
);
$L10n['element']['difficulty'] = array(
    'caption' => 'Difficulty: ',
    'options' => array(
        '' => 'Choose...',
        'very easy' => 'very easy',
        'easy' => 'easy',
        'medium' => 'medium',
        'difficult' => 'difficult',
        'very difficult' => 'very difficult',
    )
);
$L10n['common']['scale_low_high'] = array(
    '' => 'Choose...',
    'very_low' => 'very low',
    'low' => 'low',
    'medium' => 'medium',
    'high' => 'high',
    'very_high' => 'very high'
);


$L10n['element']['semantic_density'] = array(
    'caption' => 'Semantic density: '
);


$L10n['element']['indended_user'] = array(
    'caption' => 'Intended End User Role: ',
    'options' => array(
        'author' => 'author',
        'counsellor' => 'counsellor',
        'learner' => 'learner',
        'manager' => 'manager',
        'parent' => 'parent',
        'teacher' => 'teacher',
        'other' => 'other'
    )
);

$L10n['element']['context'] = array(
    'caption' => 'Context: ',
    'options' => array(
        'pre-school' => 'pre-school',
        'compulsory_education' => 'compulsory education',
        'special_education' => 'special education',
        'vocational_education' => 'vocational education',
#            'higher_education' => array(
#                'type' => 'optgroup',
#                'label' => 'learning asset',
#                'options' => array( 
        'post-graduate_education' => 'post-graduate education',
        'pre-graduate_education' => 'pre-graduate education',
#                )
#            ),
        'distance_education' => 'distance education',
        'continuing_education' => 'continuing education',
        'professional_development' => 'professional development',
        'library' => 'library',
        'educational_administration' => 'educational administration',
        'policy_making' => 'policy making',
        'other' => 'other',
    )
);

$L10n['element']['typical_age'] = array(
    'caption' => 'Typical Age Range: ',
);

$L10n['element']['difficulty'] = array(
    'caption' => 'Difficulty: ',
    'options' => array(
        '' => 'Choose…',
        'very_easy' => 'very easy',
        'easy' => 'easy',
        'medium' => 'medium',
        'difficult' => 'difficult',
        'very_difficult' => 'very difficult'
    )
);


$L10n['element']['learning_time'] = array(
    'caption' => 'Typical Learning Time: ',
);

$L10n['element']['description5'] = array(
    'caption' => 'Description',
    'cardinality_add' => 'Add another description',
    'cardinality_hide' => 'Ignore this description'
);

$L10n['element']['language5'] = array(
    'caption' => 'Intended User Language(s)',
    'seachtext' => 'Type here to search list',
    'options' => null
);

$L10n['common']['opt_yes'] = 'Yes';
$L10n['common']['opt_no'] = 'No';

// FIXME: this must be implemented only with "options" of different class
$L10n['element']['coverage'] = array(
    'caption' => 'Coverage',
    'seachtext' => 'Type here and press [TAB] to search list...',
    'options' => array(
        'Africa' => array('html' => 'Africa', 'class' => 'level_1'),
        'Central_Africa' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;Central Africa', 'class' => 'level_1'),
        'East_Africa' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;East Africa', 'class' => 'level_1'),
        'Southern_Africa' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;Southern Africa', 'class' => 'level_1'),
        'West_Africa' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;West Africa', 'class' => 'level_1'),
        'America' => array('html' => 'America', 'class' => 'level_1'),
        'Central_America' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;Central America', 'class' => 'level_1'),
        'Canada' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Canada', 'class' => 'level_1'),
        'USA' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;USA', 'class' => 'level_1'),
        'South_America' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;South America', 'class' => 'level_1'),
        'Antarctica' => array('html' => 'Antarctica', 'class' => 'level_1'),
        'Arctic' => array('html' => 'Arctic', 'class' => 'level_1'),
        'Asia' => array('html' => 'Asia', 'class' => 'level_1'),
        'Central_Asia' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;Central Asia', 'class' => 'level_1'),
        'Far_East' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;Far East', 'class' => 'level_1'),
        'China' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;China', 'class' => 'level_1'),
        'Japan' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Japan', 'class' => 'level_1'),
        'India' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;India', 'class' => 'level_1'),
        'Middle_East' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;Middle East', 'class' => 'level_1'),
        'Cyprus' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cyprus', 'class' => 'level_1'),
        'Israel' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Israel', 'class' => 'level_1'),
        'Palestine' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Palestine', 'class' => 'level_1'),
        'Turkey' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Turkey', 'class' => 'level_1'),
        'Southeast_Asia' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;Southeast Asia', 'class' => 'level_1'),
        'Europe' => array('html' => 'Europe', 'class' => 'level_1'),
        'Central_and_Eastern_Europe' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;Central and Eastern Europe', 'class' => 'level_1'),
        'Albania' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Albania', 'class' => 'level_1'),
        'Belarus' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Belarus', 'class' => 'level_1'),
        'Bosnia_and_Herzegovina' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bosnia and Herzegovina', 'class' => 'level_1'),
        'Bulgaria' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bulgaria', 'class' => 'level_1'),
        'Croatia' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Croatia', 'class' => 'level_1'),
        'Czech_Republic' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Czech Republic', 'class' => 'level_1'),
        'Estonia' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Estonia', 'class' => 'level_1'),
        'Hungary' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hungary', 'class' => 'level_1'),
        'Latvia' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Latvia', 'class' => 'level_1'),
        'Lithuania' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lithuania', 'class' => 'level_1'),
        'Moldova' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Moldova', 'class' => 'level_1'),
        'Poland' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Poland', 'class' => 'level_1'),
        'Romania' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Romania', 'class' => 'level_1'),
        'Russia' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Russia', 'class' => 'level_1'),
        'Slovakia' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Slovakia', 'class' => 'level_1'),
        'Slovenia' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Slovenia', 'class' => 'level_1'),
        'Turkey' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Turkey', 'class' => 'level_1'),
        'Ukraine' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ukraine', 'class' => 'level_1'),
        'Yugoslavia' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yugoslavia', 'class' => 'level_1'),
        'Nordic_countries' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;Nordic countries', 'class' => 'level_1'),
        'Denmark' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Denmark', 'class' => 'level_1'),
        'Faroe_Islands' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Faroe Islands', 'class' => 'level_1'),
        'Faroe_Islands' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Faroe Islands', 'class' => 'level_1'),
        'Finland' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Finland', 'class' => 'level_1'),
        'Greenland' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Greenland', 'class' => 'level_1'),
        'Iceland' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Iceland', 'class' => 'level_1'),
        'Norway' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Norway', 'class' => 'level_1'),
        'Sweden' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sweden', 'class' => 'level_1'),
        'Western_Europe' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;Western Europe', 'class' => 'level_1'),
        'Andorra' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Andorra', 'class' => 'level_1'),
        'Austria' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Austria', 'class' => 'level_1'),
        'Belgium' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Belgium', 'class' => 'level_1'),
        'Cyprus' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cyprus', 'class' => 'level_1'),
        'France' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;France', 'class' => 'level_1'),
        'Germany' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Germany', 'class' => 'level_1'),
        'Gibraltar' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gibraltar', 'class' => 'level_1'),
        'Greece' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Greece', 'class' => 'level_1'),
        'Ireland' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ireland', 'class' => 'level_1'),
        'Italy' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Italy', 'class' => 'level_1'),
        'Liechtenstein' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Liechtenstein', 'class' => 'level_1'),
        'Luxembourg' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Luxembourg', 'class' => 'level_1'),
        'Malta' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Malta', 'class' => 'level_1'),
        'Monaco' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monaco', 'class' => 'level_1'),
        'Netherlands' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Netherlands', 'class' => 'level_1'),
        'San_Marino' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;San Marino', 'class' => 'level_1'),
        'Spain' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Spain', 'class' => 'level_1'),
        'Switzerland' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Switzerland', 'class' => 'level_1'),
        'United_Kingdom' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;United Kingdom', 'class' => 'level_1'),
        'Great_Britain' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Great Britain', 'class' => 'level_1'),
        'Vatican_City' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vatican City', 'class' => 'level_1'),
        'Oceania' => array('html' => 'Oceania', 'class' => 'level_1'),
        'Australia' => array('html' => '&nbsp;&nbsp;&nbsp;&nbsp;Australia', 'class' => 'level_1')

//			'africa' => array(
//                'type' => 'optgroup',
//                'label' => 'Africa',
//				'options' => array(
//					'Central Africa' => 'Central Africa',
//					'East Africa' => 'East Africa',
//					'Southern Africa' => 'Southern Africa',
//					'West Africa' => 'West Africa'						
//				)
//			),
//			'america' => array(
//                'type' => 'optgroup',
//                'label' => 'America',
//				'options' => array(
//					'central_america' => array(
//						'type' => 'optgroup',
//						'label' => 'Central America',
//						'options' => array(
//							'Canada' => 'Canada',
//							'USA' => 'USA'
//						)
//					),
//					'South America' => 'South America'
//				)
//					
//			), 
//			'central-east_eu' => array(
//                'type' => 'optgroup',
//                'label' => 'Central and Eastern Europe',
//                'options' => array(
//                    'Albania' => 'Albania',
//                    'Belarus' => 'Belarus',
//                    'Bosnia and Herzegovina' => 'Bosnia and Herzegovina',
//                    'Bulgaria' => 'Bulgaria',
//                    'Croatia' => 'Croatia',
//                    'Czech Republic' => 'Czech Republic',
//                    'Estonia' => 'Estonia',
//                    'Hungary' => 'Hungary',
//                    'Latvia' => 'Latvia',
//                    'Lithuania' => 'Lithuania',
//                    'Moldova' => 'Moldova',
//                    'Poland' => 'Poland',
//                    'Romania' => 'Romania',
//                    'Russia' => 'Russia',
//                    'Slovakia' => 'Slovakia',
//                    'Slovenia' => 'Slovenia',
//                    'Turkey' => 'Turkey',
//                    'Ukraine' => 'Ukraine',
//                    'Yugoslavia' => 'Yugoslavia',
//                ),
//            ),
//            'western_eu' => array(
//                'type' => 'optgroup',
//                'label' => 'Western Europe',
//                'options' => array(
//                    'Andorra' => 'Andorra',
//                    'Austria' => 'Austria',
//                    'Belgium' => 'Belgium',
//                    'Cyprus' => 'Cyprus',
//                    'France' => 'France',
//                    'Germany' => 'Germany',
//                    'Gibraltar' => 'Gibraltar',
//                    'Greece' => 'Greece',
//                    'Ireland' => 'Ireland',
//                    'Italy' => 'Italy',
//                    'Liechtenstein' => 'Liechtenstein',
//                    'Luxembourg' => 'Luxembourg',
//                    'Malta' => 'Malta',
//                    'Monaco' => 'Monaco',
//                    'Netherlands' => 'Netherlands',
//                    'Portugal' => 'Portugal',
//                    'San Marino' => 'San Marino',
//                    'Spain' => 'Spain',
//                    'Switzerland' => 'Switzerland',
//                    'United Kingdom' => 'United Kingdom',
//                )
//            )
    )
);
$L10n['element']['translationSelectLanguage'] = array(
    'caption' => 'Check all the languages for which you will provide translations, with the assistance of Automatic Machine Translation services. ',
    'searchtext' => 'Type here and press [TAB] to search list...',
    'options' => array(
        'en' => array('html' => 'English', 'class' => 'level_1'),
        'el' => array('html' => 'Greek', 'class' => 'level_1'),
        'es' => array('html' => 'Estonian', 'class' => 'level_1'),
        'ru' => array('html' => 'Russian', 'class' => 'level_1'),
        'fr' => array('html' => 'French', 'class' => 'level_1'),
        'de' => array('html' => 'German', 'class' => 'level_1'),
        'es' => array('html' => 'Spanish', 'class' => 'level_1'),
        'it' => array('html' => 'Italian', 'class' => 'level_1'),
        'tr' => array('html' => 'Turkish', 'class' => 'level_1'),
        'lv' => array('html' => 'Latvian', 'class' => 'level_1')
    )
);

echo json_encode($L10n);
return $L10n;
#}
    
