<?php
/**
 * THEMENGIFT Smart Tag System - Setup Wizard (Premium Radiant UI Design)
 */
if (!isset($pdo)) die('Direct access not permitted');
if (empty($_SESSION['user_id'])) {
    header('Location: /my-tag/login');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tag Setup — THEMENGIFT Smart Tags</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: #FBFBFD;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 32px 16px 64px;
            color: #1D1D1F;
        }

        /* Header */
        .wizard-header {
            text-align: center;
            margin-bottom: 32px;
        }
        .brand {
            font-family: 'Playfair Display', serif;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.2em;
            color: #0A2463;
            text-transform: uppercase;
        }
        .wizard-title {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            font-weight: 700;
            color: #0A192F;
            margin-top: 6px;
        }
        .wizard-sub { font-size: 14px; color: #86868B; margin-top: 4px; }

        /* Card */
        .wizard-card {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 24px 48px rgba(0,0,0,0.07);
            width: 100%;
            max-width: 560px;
            overflow: hidden;
        }

        /* Step Indicator */
        .step-bar {
            background: linear-gradient(135deg, #0A2463, #172A45);
            padding: 24px 32px;
        }
        .steps-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }
        .steps-row::before {
            content: '';
            position: absolute;
            top: 16px;
            left: 16px;
            right: 16px;
            height: 2px;
            background: rgba(255,255,255,0.2);
            z-index: 0;
        }
        .step-dot {
            width: 32px; height: 32px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700;
            position: relative; z-index: 1;
            transition: all 0.3s ease;
        }
        .step-dot.active { background: #D4AF37; color: #0A2463; box-shadow: 0 0 0 4px rgba(212,175,55,0.3); }
        .step-dot.done { background: rgba(255,255,255,0.9); color: #0A2463; }
        .step-dot.pending { background: rgba(255,255,255,0.15); color: rgba(255,255,255,0.5); border: 2px solid rgba(255,255,255,0.2); }
        .steps-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
        .step-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.5);
            text-align: center;
            flex: 1;
        }
        .step-label.active { color: #D4AF37; }

        /* Form */
        .step-body { padding: 32px; }
        .step-heading { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; color: #0A192F; margin-bottom: 6px; }
        .step-desc { font-size: 14px; color: #86868B; margin-bottom: 24px; }

        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 12px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: #86868B; margin-bottom: 8px; }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #E5E5EA;
            border-radius: 12px;
            font-family: inherit;
            font-size: 15px;
            color: #1D1D1F;
            background: #FBFBFD;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }
        .form-control:focus {
            border-color: #0A2463;
            box-shadow: 0 0 0 3px rgba(10,36,99,0.1);
            background: #fff;
        }

        /* Type Selector */
        .type-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
        .type-option { display: none; }
        .type-label {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            border: 1.5px solid #E5E5EA;
            border-radius: 14px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            color: #1D1D1F;
            transition: all 0.2s;
            background: #FBFBFD;
        }
        .type-label:hover { border-color: #0A2463; background: #fff; }
        .type-option:checked + .type-label {
            border-color: #0A2463;
            background: #EEF2FF;
            color: #0A2463;
            box-shadow: 0 0 0 3px rgba(10,36,99,0.08);
        }
        .type-emoji { font-size: 22px; }

        /* Buttons */
        .btn-row { display: flex; gap: 12px; justify-content: flex-end; margin-top: 28px; }
        .btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 12px 24px;
            border-radius: 12px;
            font-size: 14px; font-weight: 700;
            cursor: pointer; border: none;
            transition: all 0.25s ease;
        }
        .btn-primary { background: #0A2463; color: #fff; }
        .btn-primary:hover { background: #172A45; transform: translateY(-1px); box-shadow: 0 8px 20px rgba(10,36,99,0.2); }
        .btn-outline { background: transparent; color: #0A2463; border: 1.5px solid #E5E5EA; }
        .btn-outline:hover { border-color: #0A2463; background: #F6F8FA; }

        /* Photo upload */
        .photo-upload {
            border: 2px dashed #E5E5EA;
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s;
        }
        .photo-upload:hover { border-color: #0A2463; }
        .photo-upload input { display: none; }
        .photo-upload-icon { font-size: 32px; margin-bottom: 8px; }
        .photo-upload-text { font-size: 13px; color: #86868B; }
        .photo-upload-text strong { color: #0A2463; }

        /* Success state */
        .wizard-success { display: none; text-align: center; padding: 48px 32px; }
        .success-icon { font-size: 64px; margin-bottom: 16px; }
        .success-title { font-family: 'Playfair Display', serif; font-size: 24px; font-weight: 700; color: #0A192F; margin-bottom: 8px; }
        .success-sub { font-size: 14px; color: #86868B; max-width: 320px; margin: 0 auto 24px; }

        .step-panel { display: none; }
        .step-panel.active { display: block; }
    </style>
</head>
<body>
    <div class="wizard-header">
        <div class="brand">TheMenGift</div>
        <div class="wizard-title">Smart Tag Setup</div>
        <div class="wizard-sub">Set up your tag in 4 easy steps</div>
    </div>

    <div class="wizard-card">
        <!-- Step Bar -->
        <div class="step-bar">
            <div class="steps-row">
                <div class="step-dot active" id="dot-1">1</div>
                <div class="step-dot pending" id="dot-2">2</div>
                <div class="step-dot pending" id="dot-3">3</div>
                <div class="step-dot pending" id="dot-4">✓</div>
            </div>
            <div class="steps-labels">
                <div class="step-label active" id="lbl-1">Tag Type</div>
                <div class="step-label" id="lbl-2">Contact</div>
                <div class="step-label" id="lbl-3">Details</div>
                <div class="step-label" id="lbl-4">Confirm</div>
            </div>
        </div>

        <form id="setup-form" action="" method="POST" enctype="multipart/form-data">
            <?php if (function_exists('wp_nonce_field')) wp_nonce_field('tmg_setup', 'tmg_setup_nonce'); ?>

            <!-- Step 1: Tag Type -->
            <div class="step-body step-panel active" id="step-1">
                <div class="step-heading">What is this tag for?</div>
                <div class="step-desc">Choose the type that best fits your tag. You can change it later.</div>

                <div class="form-group">
                    <div class="type-grid">
                        <?php
                        $types = [
                            ['value'=>'pet',     'emoji'=>'🐾', 'label'=>'Pet'],
                            ['value'=>'travel',  'emoji'=>'🧳', 'label'=>'Travel / Luggage'],
                            ['value'=>'medical', 'emoji'=>'🏥', 'label'=>'Medical Alert'],
                            ['value'=>'kids',    'emoji'=>'👧', 'label'=>'Kids Safety'],
                            ['value'=>'vehicle', 'emoji'=>'🚗', 'label'=>'Vehicle / Keys'],
                            ['value'=>'corporate','emoji'=>'💼','label'=>'Corporate'],
                        ];
                        foreach($types as $t): ?>
                        <input type="radio" name="tag_type" value="<?= $t['value'] ?>" id="type_<?= $t['value'] ?>" class="type-option" <?= $t['value']==='pet'?'checked':'' ?>>
                        <label for="type_<?= $t['value'] ?>" class="type-label">
                            <span class="type-emoji"><?= $t['emoji'] ?></span>
                            <?= $t['label'] ?>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Name (pet name, your name, or item name)</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. Bruno or Rahul Sharma" required>
                </div>

                <div class="form-group">
                    <div class="photo-upload" onclick="document.getElementById('photo-input').click()">
                        <input type="file" name="photo" id="photo-input" accept="image/*">
                        <div class="photo-upload-icon">📸</div>
                        <div class="photo-upload-text"><strong>Click to upload photo</strong> or drag & drop<br>JPG, PNG up to 5MB</div>
                    </div>
                </div>

                <div class="btn-row">
                    <button type="button" class="btn btn-primary" onclick="goStep(2)">
                        Contact Details
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>

            <!-- Step 2: Contact Details -->
            <div class="step-body step-panel" id="step-2">
                <div class="step-heading">How can someone reach you?</div>
                <div class="step-desc">Shown when someone scans your tag. First name only is fine for privacy.</div>

                <div class="form-group">
                    <label class="form-label">Your Name (Owner)</label>
                    <input type="text" name="owner_name" class="form-control" placeholder="First name is enough">
                </div>
                <div class="form-group">
                    <label class="form-label">Primary Phone Number</label>
                    <input type="tel" name="owner_phone" class="form-control" placeholder="+91 98765 43210" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Secondary Emergency Contact (Optional)</label>
                    <input type="tel" name="emergency_contact_2" class="form-control" placeholder="+91 98765 43210">
                </div>

                <div class="btn-row">
                    <button type="button" class="btn btn-outline" onclick="goStep(1)">← Back</button>
                    <button type="button" class="btn btn-primary" onclick="goStep(3)">
                        Additional Details
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>

            <!-- Step 3: Additional Details -->
            <div class="step-body step-panel" id="step-3">
                <div class="step-heading">Additional Information</div>
                <div class="step-desc">The more detail, the more helpful your tag is. All fields are optional.</div>

                <div id="pet-fields">
                    <div class="form-group">
                        <label class="form-label">Breed / Species</label>
                        <input type="text" name="breed" class="form-control" placeholder="e.g. Golden Retriever">
                    </div>
                </div>
                <div id="medical-fields" style="display:none">
                    <div class="form-group">
                        <label class="form-label">Blood Group</label>
                        <select name="blood_group" class="form-control">
                            <option value="">Select...</option>
                            <?php foreach(['A+','A-','B+','B-','O+','O-','AB+','AB-'] as $bg): ?>
                            <option><?= $bg ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Medical Conditions</label>
                        <textarea name="medical_conditions" class="form-control" rows="3" placeholder="e.g. Diabetic, Epileptic..."></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Severe Allergies</label>
                        <input type="text" name="allergies" class="form-control" placeholder="e.g. Penicillin, Nuts">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Current Medications</label>
                        <textarea name="medications" class="form-control" rows="2" placeholder="List key medications..."></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Description / Notes</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Any additional info..."></textarea>
                </div>

                <div class="btn-row">
                    <button type="button" class="btn btn-outline" onclick="goStep(2)">← Back</button>
                    <button type="button" class="btn btn-primary" onclick="goStep(4)">
                        Review & Save
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>

            <!-- Step 4: Confirm -->
            <div class="step-body step-panel" id="step-4">
                <div class="step-heading">Ready to activate!</div>
                <div class="step-desc">Your QR profile will be live the moment you save. You can update it anytime, for free, forever.</div>

                <div style="background:#F6F8FA; border-radius:16px; padding:20px; margin-bottom:20px; font-size:14px; color:#86868B; line-height:1.8;">
                    ✓ &nbsp;Lifetime QR profile — free forever<br>
                    ✓ &nbsp;Silent GPS scanning alert to your phone<br>
                    ✓ &nbsp;Update info anytime from your dashboard<br>
                    ✓ &nbsp;Premium profile page for whoever finds your tag
                </div>

                <div class="btn-row">
                    <button type="button" class="btn btn-outline" onclick="goStep(3)">← Back</button>
                    <button type="submit" class="btn btn-primary" style="background:#D4AF37; color:#0A2463;">
                        🚀 Activate My Tag
                    </button>
                </div>
            </div>
        </form>

        <!-- Success State (shown after JS submit) -->
        <div class="wizard-success" id="wizard-success">
            <div class="success-icon">🎉</div>
            <div class="success-title">Tag is Live!</div>
            <div class="success-sub">Your QR profile is now active. Scan the tag to see your live profile.</div>
            <a href="/my-tag/dashboard" class="btn btn-primary" style="display:inline-flex;margin:0 auto;">Go to Dashboard →</a>
        </div>
    </div>

    <script>
    var currentStep = 1;

    function goStep(n) {
        document.getElementById('step-' + currentStep).classList.remove('active');
        currentStep = n;
        document.getElementById('step-' + n).classList.add('active');

        // Update step bar
        for(var i=1; i<=4; i++){
            var dot = document.getElementById('dot-'+i);
            var lbl = document.getElementById('lbl-'+i);
            dot.className = 'step-dot ' + (i < n ? 'done' : i === n ? 'active' : 'pending');
            dot.textContent = i < n ? '✓' : i;
            lbl.className = 'step-label' + (i === n ? ' active' : '');
        }

        // Show/hide medical vs pet fields
        var tagType = document.querySelector('input[name="tag_type"]:checked')?.value;
        document.getElementById('medical-fields').style.display = tagType === 'medical' ? '' : 'none';
        document.getElementById('pet-fields').style.display = tagType === 'pet' ? '' : 'none';

        window.scrollTo(0, 0);
    }

    // Photo preview
    document.getElementById('photo-input').addEventListener('change', function(){
        if(this.files && this.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                var div = document.querySelector('.photo-upload');
                div.innerHTML = '<img src="'+e.target.result+'" style="width:80px;height:80px;border-radius:50%;object-fit:cover;margin:0 auto 8px;display:block;"><div class="photo-upload-text">Photo selected ✓</div>';
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
    </script>
</body>
</html>
