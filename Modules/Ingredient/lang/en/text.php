<?php
use \Carbon\Carbon;
return [

    'name' => 'Name',
    'slug' => 'Slug',
    'description' => 'Description',
    'status' => 'Status',
    'created_by' => 'Created By',
    'updated_at' => 'Updated At',
    'updated_by' => 'Updated By',
    'deleted_by' => 'Deleted By',
    'action' => 'Action',
    'stock'=>'Quantity In Stock',
    'expiry_date'=>'Expire On',
    'units' => [
        'KG' => 'Kilogram',
        'L' => 'Liter',
        'Bottles' => 'Bottles',
        'Packs' => 'Packs',
    ],
    'ingredients_name' => [
        'Oat Milk'=>'Oat Milk',
        'Glycerine'=>'Glycerine',
        'Avocado Butter'=>'Avocado Butter',
        'Fair Trade Olive Oil'=>'Fair Trade Olive Oil',
        'Perfume'=>'Perfume',
        'Cetearyl Alcohol'=>'Cetearyl Alcohol',
        'Extra Virgin Coconut Oil'=>'Extra Virgin Coconut Oil',
        'Glyceryl Stearate'=>'Glyceryl Stearate',
        'PEG-100 Stearate'=>'PEG-100 Stearate',
        'Organic Jojoba Oil'=>'Organic Jojoba Oil',
        'Orange Flower Absolute'=>'Orange Flower Absolute',
        'Jasmine Absolute'=>'Jasmine Absolute',
        'Cupuaçu Butter'=>'Cupuaçu Butter',
        'Organic Candelilla Wax'=>'Organic Candelilla Wax',
        'Phenoxyethanol'=>'Phenoxyethanol',
        'Benzyl Alcohol'=>'Benzyl Alcohol',
        'Benzyl Benzoate'=>'Benzyl Benzoate',
        'Benzyl Salicylate'=>'Benzyl Salicylate',
        'Citral'=>'Citral',
        'Eugenol'=>'Eugenol',
        'Farnesol'=>'Farnesol',
        'Geraniol'=>'Geraniol',
        'Hydroxycitronellal'=>'Hydroxycitronellal',
        'Isoeugenol'=>'Isoeugenol',
        'Limonene'=>'Limonene',
        'Linalool'=>'Linalool',
    ],
    'products' => [
        'Oat Milk Bath Bombs'=>'Oat Milk Bath Bombs',
        'Avocado Butter Body Lotion'=>'Avocado Butter Body Lotion',
        'Coconut Oil and Jojoba Oil Shampoo'=>'Coconut Oil and Jojoba Oil Shampoo',
        'Jasmine and Orange Flower Body Wash'=>'Jasmine and Orange Flower Body Wash',
        'Cupuaçu Butter Facial Cream'=>'Cupuaçu Butter Facial Cream',
        'Citrus Hand Soap'=>'Citrus Hand Soap',
        'Lavender and Rose Bath Salts'=>'Lavender and Rose Bath Salts',
        'Eucalyptus Body Scrub'=>'Eucalyptus Body Scrub',
        'Rose Petal Face Mask'=>'Rose Petal Face Mask',
        'Lemon and Mint Lip Balm'=>'Lemon and Mint Lip Balm',
    ],'inventoryLocations' => [
        'Bulk Storage'=>'Bulk Storage',
        'Pallet Racking'=>'Pallet Racking',
        'Shelving Units'=>'Shelving Units',
        'Aisle Storage'=>'Aisle Storage',
        'Loading Bay'=>'Loading Bay',
        'Cold Storage'=>'Cold Storage',
        'Hazardous Materials Storage'=>'Hazardous Materials Storage',
        'Controlled Environment Storage'=>'Controlled Environment Storage',
        'High-Value Storage'=>'High-Value Storage',
        'Quarantine Area'=>'Quarantine Area',
        'Raw Materials Storage'=>'Raw Materials Storage',
        'Finished Goods Area'=>'Finished Goods Area',
        'Work in Progress (WIP) Zone'=>'Work in Progress (WIP) Zone',
        'Returns and Damages Area'=>'Returns and Damages Area',
        'Quality Control Checkpoint'=>'Quality Control Checkpoint',
        'Receiving Area'=>'Receiving Area',
        'Shipping Area'=>'Shipping Area',
        'Cross-Docking Area'=>'Cross-Docking Area',
        'Staging Area'=>'Staging Area',
        'Order Fulfillment Zone'=>'Order Fulfillment Zone',
        'Inventory Cage'=>'Inventory Cage',
        'Bin Location'=>'Bin Location',
        'Overflow Storage'=>'Overflow Storage',
        'Mezzanine Level'=>'Mezzanine Level',
        'Bulkhead Storage'=>'Bulkhead Storage',
    ],'suppliers' => [
        [
            'name' => 'Brenntag',
            'slug' => 'brenntag',
            'description' => 'Global leader in chemical distribution.',
            'status' => 1,
            'ContactName' => 'John Doe',
            'ContactEmail' => 'john.doe@brenntag.com',
            'ContactPhone' => '+1 (123) 456-7890',
            'Address' => '123 Chemical Avenue',
            'City' => 'Cityville',
            'State' => 'State X',
            'ZipCode' => '12345',
            'Country' => 'Country X',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ],
        [
            'name' => 'Univar Solutions',
            'slug' => 'univar-solutions',
            'description' => 'Provider of chemicals and ingredients.',
            'status' => 1,
            'ContactName' => 'Jane Smith',
            'ContactEmail' => 'jane.smith@univar.com',
            'ContactPhone' => '+1 (234) 567-8901',
            'Address' => '456 Ingredient Street',
            'City' => 'Townsville',
            'State' => 'State Y',
            'ZipCode' => '54321',
            'Country' => 'Country Y',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ],
        [
            'name' => 'BASF',
            'slug' => 'basf',
            'description' => 'Leading chemical company.',
            'status' => 1,
            'ContactName' => 'Michael Brown',
            'ContactEmail' => 'michael.brown@basf.com',
            'ContactPhone' => '+1 (345) 678-9012',
            'Address' => '789 Polymer Road',
            'City' => 'Metropolis',
            'State' => 'State Z',
            'ZipCode' => '67890',
            'Country' => 'Country Z',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ],
        [
            'name' => 'Dow Chemical Company',
            'slug' => 'dow-chemical-company',
            'description' => 'Innovation leader in chemistry.',
            'status' => 1,
            'ContactName' => 'Sarah Johnson',
            'ContactEmail' => 'sarah.johnson@dow.com',
            'ContactPhone' => '+1 (456) 789-0123',
            'Address' => '101 Dow Drive',
            'City' => 'Tech City',
            'State' => 'State A',
            'ZipCode' => '13579',
            'Country' => 'Country A',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ],
        [
            'name' => 'Dupont',
            'slug' => 'dupont',
            'description' => 'Science and innovation company.',
            'status' => 1,
            'ContactName' => 'Robert Smith',
            'ContactEmail' => 'robert.smith@dupont.com',
            'ContactPhone' => '+1 (567) 890-1234',
            'Address' => '246 Dupont Boulevard',
            'City' => 'Chemtown',
            'State' => 'State B',
            'ZipCode' => '97531',
            'Country' => 'Country B',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ],
        [
            'name' => 'Evonik Industries',
            'slug' => 'evonik-industries',
            'description' => 'Specialty chemicals company.',
            'status' => 1,
            'ContactName' => 'Emily White',
            'ContactEmail' => 'emily.white@evonik.com',
            'ContactPhone' => '+1 (678) 901-2345',
            'Address' => '369 Specialty Avenue',
            'City' => 'Technopolis',
            'State' => 'State C',
            'ZipCode' => '24680',
            'Country' => 'Country C',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ],
        [
            'name' => 'Arkema',
            'slug' => 'arkema',
            'description' => 'Global manufacturer of specialty chemicals.',
            'status' => 1,
            'ContactName' => 'Daniel Johnson',
            'ContactEmail' => 'daniel.johnson@arkema.com',
            'ContactPhone' => '+1 (789) 012-3456',
            'Address' => '808 Arkema Place',
            'City' => 'Chemville',
            'State' => 'State D',
            'ZipCode' => '64280',
            'Country' => 'Country D',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ],
        [
            'name' => 'Ashland',
            'slug' => 'ashland',
            'description' => 'Leading global specialty chemicals company.',
            'status' => 1,
            'ContactName' => 'Jessica Brown',
            'ContactEmail' => 'jessica.brown@ashland.com',
            'ContactPhone' => '+1 (890) 123-4567',
            'Address' => '505 Additive Street',
            'City' => 'Polymer City',
            'State' => 'State E',
            'ZipCode' => '35791',
            'Country' => 'Country E',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ],
        [
            'name' => 'Clariant',
            'slug' => 'clariant',
            'description' => 'Specialty chemicals company.',
            'status' => 1,
            'ContactName' => 'Christopher Davis',
            'ContactEmail' => 'christopher.davis@clariant.com',
            'ContactPhone' => '+1 (234) 567-8901',
            'Address' => '212 Clariant Lane',
            'City' => 'Biochem Valley',
            'State' => 'State F',
            'ZipCode' => '80246',
            'Country' => 'Country F',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ],
        [
            'name' => 'Croda International',
            'slug' => 'croda-international',
            'description' => 'Specialty chemicals and ingredients company.',
            'status' => 1,
            'ContactName' => 'Jennifer Green',
            'ContactEmail' => 'jennifer.green@croda.com',
            'ContactPhone' => '+1 (456) 789-0123',
            'Address' => '777 Croda Avenue',
            'City' => 'Biochemville',
            'State' => 'State G',
            'ZipCode' => '91111',
            'Country' => 'Country G',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ],
    ]
    
    
    
    
];