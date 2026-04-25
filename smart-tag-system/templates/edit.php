<?php
// Get tag type from database
$tag_type = $tag['tag_type']; // e.g. 'motorbike', 'dog', 'medical'

// Define fields per tag type
$field_sets = [
    // PET TYPES
    'dog' => ['pet_name','breed','colour','gender','age','temperament','vaccinated','blood_group','allergies','medications','medical_conditions','vet_name','vet_phone','microchip_number','registration_number','neutered','favourite_food','special_habits','owner_firstname','owner_phone','owner_whatsapp','emergency_contact_name','emergency_contact_phone','message_to_finder','finder_instructions'],
    'cat' => ['pet_name','breed','colour','gender','age','indoor_outdoor','vaccinated','blood_group','allergies','medications','vet_name','vet_phone','microchip_number','neutered','favourite_food','owner_firstname','owner_phone','owner_whatsapp','emergency_contact_name','emergency_contact_phone','message_to_finder'],
    'rabbit' => ['pet_name','breed','colour','gender','age','vaccinated','diet','cage_type','owner_firstname','owner_phone','owner_whatsapp','emergency_contact_name','emergency_contact_phone','message_to_finder'],
    'horse' => ['pet_name','breed','colour','gender','age','vaccinated','stable_name','stable_address','vet_name','vet_phone','owner_firstname','owner_phone','owner_whatsapp','message_to_finder'],
    'bird' => ['pet_name','species','colour','gender','age','owner_firstname','owner_phone','owner_whatsapp','message_to_finder'],
    'farm_animal' => ['pet_name','species','colour','gender','owner_firstname','owner_phone','owner_whatsapp','farm_name','message_to_finder'],

    // TRAVEL TYPES
    'luggage' => ['owner_firstname','owner_phone','owner_whatsapp','bag_colour','bag_brand','bag_size','contents_general','distinguishing_marks','flight_number','destination','return_date','hotel_name','emergency_contact_name','emergency_contact_phone','message_to_finder'],
    'backpack' => ['owner_firstname','owner_phone','owner_whatsapp','bag_colour','bag_brand','bag_size','contents_general','distinguishing_marks','emergency_contact_name','emergency_contact_phone','message_to_finder'],
    'laptop_bag' => ['owner_firstname','owner_phone','owner_whatsapp','bag_colour','bag_brand','laptop_model','distinguishing_marks','message_to_finder'],
    'camera_bag' => ['owner_firstname','owner_phone','owner_whatsapp','bag_colour','bag_brand','camera_model','distinguishing_marks','message_to_finder'],
    'passport' => ['owner_firstname','owner_phone','owner_whatsapp','nationality','destination','return_date','emergency_contact_name','emergency_contact_phone'],

    // VEHICLE TYPES
    'car_keys' => ['owner_firstname','owner_phone','owner_whatsapp','vehicle_type','vehicle_brand','vehicle_model','vehicle_colour','registration_last4','vehicle_year','special_marks','message_to_finder'],
    'bicycle' => ['owner_firstname','owner_phone','owner_whatsapp','bicycle_brand','bicycle_colour','bicycle_type','frame_number_last4','special_marks','message_to_finder'],
    'motorbike' => ['owner_firstname','owner_phone','owner_whatsapp','vehicle_brand','vehicle_model','vehicle_colour','registration_last4','vehicle_year','helmet_colour','special_marks','message_to_finder'],
    'scooter' => ['owner_firstname','owner_phone','owner_whatsapp','vehicle_brand','vehicle_model','vehicle_colour','registration_last4','special_marks','message_to_finder'],
    'helmet' => ['owner_firstname','owner_phone','owner_whatsapp','helmet_brand','helmet_colour','helmet_size','vehicle_brand','message_to_finder'],

    // KIDS SAFETY
    'school_bag' => ['child_firstname','school_name','class_section','bus_route','bus_stop','parent1_name','parent1_phone','parent1_whatsapp','parent2_name','parent2_phone','teacher_name','school_office','blood_group','allergies','medical_conditions','doctor_contact','home_area'],
    'kids_id_band' => ['child_firstname','age','school_name','parent1_name','parent1_phone','parent1_whatsapp','parent2_name','parent2_phone','blood_group','allergies','home_area'],
    'kids_shoe' => ['child_firstname','age','school_name','parent1_name','parent1_phone','parent2_name','parent2_phone','home_area'],

    // MEDICAL TYPES
    'medical' => ['full_name','age','blood_group','primary_condition','medications','drug_allergies','do_not_do','emergency_contact1_name','emergency_contact1_relationship','emergency_contact1_phone','emergency_contact2_name','emergency_contact2_phone','doctor_name','doctor_phone','doctor_clinic','preferred_hospital','hospital_emergency','insurance_company','insurance_policy','insurance_helpline','step_by_step'],
    'emergency' => ['full_name','age','blood_group','primary_condition','medications','drug_allergies','emergency_contact1_name','emergency_contact1_phone','emergency_contact2_name','emergency_contact2_phone','doctor_name','doctor_phone','preferred_hospital'],
    'allergy' => ['full_name','age','blood_group','allergy_list','drug_allergies','epipen','medications','emergency_contact1_name','emergency_contact1_phone','doctor_name','doctor_phone'],
    'blood_group' => ['full_name','age','blood_group','rh_factor','rare_antibodies','emergency_contact1_name','emergency_contact1_phone'],

    // ASSET TYPES
    'electronics' => ['owner_firstname','owner_phone','owner_whatsapp','device_type','device_brand','device_model','device_colour','device_serial_last4','case_description','instructions'],
    'instrument' => ['owner_firstname','owner_phone','owner_whatsapp','instrument_type','brand','model','colour','serial_last4','case_description','message_to_finder'],
    'toolbox' => ['owner_firstname','owner_phone','owner_whatsapp','box_colour','box_brand','contents_general','distinguishing_marks','message_to_finder'],
    'umbrella' => ['owner_firstname','owner_phone','owner_whatsapp','umbrella_colour','umbrella_brand','message_to_finder'],
    'wallet' => ['owner_firstname','owner_phone','owner_whatsapp','wallet_colour','wallet_brand','distinguishing_marks','message_to_finder'],

    // CORPORATE TYPES
    'employee_id' => ['employee_name','designation','department','employee_id','company_name','company_logo_path','office_phone','company_email','work_location','working_hours','office_address','hr_contact_name','hr_contact_phone','security_desk','company_website','brand_color_primary'],
    'asset' => ['asset_name','asset_type','company_name','department','assigned_to','asset_serial_last4','office_address','it_helpdesk_phone','message_to_finder'],
    'event_badge' => ['employee_name','designation','company_name','event_name','event_date','event_venue','emergency_contact_name','emergency_contact_phone'],

    // OTHER
    'couple' => ['person1_name','person1_photo','person2_name','person2_photo','anniversary_date','message','owner_phone','owner_whatsapp'],
    'souvenir' => ['item_name','location_name','date_acquired','memory_note','owner_firstname','owner_phone'],
];

$fields = $field_sets[$tag_type] ?? $field_sets['dog'];
$profile = json_decode($tag['profile_data'], true) ?? [];
?>

<form class="tmg-edit-form" method="POST" enctype="multipart/form-data">
    <h2>Edit Tag: <?= htmlspecialchars($profile['pet_name'] ?? $profile['owner_firstname'] ?? 'My Tag') ?></h2>
    <p class="tag-type-badge">📌 Tag Type: <?= strtoupper(str_replace('_',' ', $tag_type)) ?></p>

    <?php foreach ($fields as $field_key): ?>
        <?php
        $field_labels = [
            'pet_name' => 'Pet Name', 'breed' => 'Breed', 'colour' => 'Colour / Color',
            'gender' => 'Gender', 'age' => 'Age', 'owner_firstname' => 'Your First Name',
            'owner_phone' => 'Your Phone Number', 'owner_whatsapp' => 'Your WhatsApp Number',
            'emergency_contact_name' => 'Emergency Contact Name',
            'emergency_contact_phone' => 'Emergency Contact Phone',
            'blood_group' => 'Blood Group', 'allergies' => 'Allergies',
            'medications' => 'Current Medications', 'medical_conditions' => 'Medical Conditions',
            'vet_name' => 'Vet / Doctor Name', 'vet_phone' => 'Vet / Doctor Phone',
            'microchip_number' => 'Microchip Number', 'neutered' => 'Neutered / Spayed',
            'vaccinated' => 'Vaccinations Up to Date', 'favourite_food' => 'Favourite Food (fun!)',
            'special_habits' => 'Special Habits / Notes', 'message_to_finder' => 'Message to Finder',
            'finder_instructions' => 'Step-by-Step Finder Instructions',
            'vehicle_brand' => 'Vehicle Brand', 'vehicle_model' => 'Vehicle Model',
            'vehicle_colour' => 'Vehicle Colour', 'registration_last4' => 'Registration Last 4 Digits Only',
            'flight_number' => 'Flight / Train Number', 'destination' => 'Destination City',
            'return_date' => 'Return Date', 'hotel_name' => 'Hotel Name (optional)',
            'bag_colour' => 'Bag Colour', 'bag_brand' => 'Bag Brand',
            'child_firstname' => 'Child\'s First Name Only (No Surname)',
            'school_name' => 'School Name', 'class_section' => 'Class & Section',
            'bus_route' => 'Bus Route Number', 'bus_stop' => 'Bus Stop Name',
            'parent1_name' => 'Parent 1 Name', 'parent1_phone' => 'Parent 1 Phone',
            'home_area' => 'Home Area / Neighbourhood Only (not full address)',
            'full_name' => 'Full Name', 'primary_condition' => 'Primary Medical Condition',
            'drug_allergies' => 'Drug Allergies (CRITICAL)', 'do_not_do' => 'Do NOT Do (Emergency Instructions)',
            'employee_name' => 'Employee Full Name', 'designation' => 'Job Title / Designation',
            'company_name' => 'Company Name', 'department' => 'Department',
            'office_address' => 'Office Address', 'working_hours' => 'Working Hours',
            // Add all others
        ];
        $label = $field_labels[$field_key] ?? ucwords(str_replace('_', ' ', $field_key));
        $value = htmlspecialchars($profile[$field_key] ?? '');
        $is_textarea = in_array($field_key, ['allergies','medications','medical_conditions','message_to_finder','finder_instructions','do_not_do','step_by_step','contents_general','special_habits','instructions']);
        $is_select = in_array($field_key, ['gender','blood_group','rh_factor','neutered','vaccinated','precision_type']);
        ?>
        <div class="form-field">
            <label for="<?= $field_key ?>"><?= $label ?></label>
            <?php if ($is_textarea): ?>
                <textarea name="profile_data[<?= $field_key ?>]" id="<?= $field_key ?>" rows="3"><?= $value ?></textarea>
            <?php elseif ($field_key === 'blood_group'): ?>
                <select name="profile_data[<?= $field_key ?>]" id="<?= $field_key ?>">
                    <?php foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-','Unknown'] as $bg): ?>
                        <option value="<?= $bg ?>" <?= $value===$bg?'selected':'' ?>><?= $bg ?></option>
                    <?php endforeach; ?>
                </select>
            <?php elseif ($field_key === 'gender'): ?>
                <select name="profile_data[<?= $field_key ?>]" id="<?= $field_key ?>">
                    <?php foreach(['Male','Female','Unknown'] as $g): ?>
                        <option value="<?= $g ?>" <?= $value===$g?'selected':'' ?>><?= $g ?></option>
                    <?php endforeach; ?>
                </select>
            <?php elseif ($field_key === 'neutered' || $field_key === 'vaccinated'): ?>
                <select name="profile_data[<?= $field_key ?>]" id="<?= $field_key ?>">
                    <option value="yes" <?= $value==='yes'?'selected':'' ?>>Yes</option>
                    <option value="no" <?= $value==='no'?'selected':'' ?>>No</option>
                    <option value="unknown" <?= $value==='unknown'?'selected':'' ?>>Not Sure</option>
                </select>
            <?php elseif ($field_key === 'profile_photo'): ?>
                <?php if ($tag['profile_photo']): ?>
                    <img src="/<?= $tag['profile_photo'] ?>" class="current-photo" />
                <?php endif; ?>
                <input type="file" name="profile_photo" accept="image/jpeg,image/png,image/webp" />
                <p class="field-hint">Max 2MB. JPG or PNG. Square photo recommended.</p>
            <?php else: ?>
                <input type="text" name="profile_data[<?= $field_key ?>]" id="<?= $field_key ?>" value="<?= $value ?>" />
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

    <!-- Status Toggle -->
    <div class="form-field status-toggle">
        <label>Current Status</label>
        <div class="toggle-group">
            <button type="button" class="status-btn <?= $tag['status']==='safe'?'active-safe':'' ?>" data-status="safe">✅ Safe</button>
            <button type="button" class="status-btn <?= $tag['status']==='lost'?'active-lost':'' ?>" data-status="lost">🚨 Lost</button>
        </div>
        <input type="hidden" name="status" id="status-input" value="<?= $tag['status'] ?>" />
    </div>

    <!-- Reward -->
    <div class="form-field">
        <label>Return Reward Amount (₹) — Leave empty if none</label>
        <input type="number" name="reward_amount" value="<?= $tag['reward_amount'] ?? '' ?>" placeholder="e.g. 500" />
    </div>

    <button type="submit" class="tmg-btn-primary">💾 Save Changes</button>
    <a href="/my-tag/dashboard/" class="tmg-btn-secondary">Cancel</a>
</form>
