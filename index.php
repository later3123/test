
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">

<title>RADIUS User Database</title>

<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@300;400;500;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<!-- LOGIN SCREEN -->
<div class="login-screen" id="loginScreen">

    <div class="login-bg">
        <div class="orb"></div>
        <div class="orb"></div>
        <div class="orb"></div>
        <div class="login-grid"></div>
    </div>

    <div class="login-card">

        <div class="login-logo">
            <div class="login-logo-text">
                LAPU-LAPU <span>PPPOE</span>
            </div>
            <div class="login-logo-sep"></div>
        </div>

        <div class="login-sub">RADIUS USER DATABASE</div>

        <div class="login-err" id="loginErr">
            <i class="fas fa-times-circle"></i>
            <span id="loginErrTxt"></span>
        </div>

        <div class="login-field">
            <label>Username</label>
            <div class="input-wrap">
                <input id="loginUser"
                       autocomplete="username"
                       placeholder="Enter username">
                <i class="fas fa-user input-icon"></i>
            </div>
        </div>

        <div class="login-field">
            <label>Password</label>
            <div class="input-wrap">
                <input id="loginPass"
                       type="password"
                       autocomplete="current-password"
                       placeholder="Enter password">

                <i class="fas fa-lock input-icon"></i>

                <button class="toggle-pw" type="button" id="togglePw">
                    <i class="fas fa-eye" id="loginPwIcon"></i>
                </button>
            </div>
        </div>

        <button class="login-btn" id="loginBtn">
            <i class="fas fa-sign-in-alt"></i> Sign In
        </button>

        <div class="login-attempts" id="loginAttempts"></div>

        <div class="login-footer">
            <div class="dev">RADIUS <span>DATABASE</span></div>
            <div class="secure">Protected administrator access</div>
        </div>

    </div>
</div>


<!-- MAIN APPLICATION -->
<div class="app" id="app">

<header>
    <div class="hdr">

        <div class="logo">
            <div class="logo-txt">
                RADIUS DALO <span>PPPOE</span>
            </div>
        </div>

        <div class="hdr-right">

            <div class="hdr-st">
                <div class="st-dot"></div>
                <span>MySQL connected</span>
            </div>

            <div class="hdr-user">
                <i class="fas fa-user-shield"></i>
                <span id="adminName">admin</span>
            </div>

            <button class="logout-btn" id="logoutBtn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>

        </div>
    </div>
</header>


<main>

<!-- DASHBOARD STATISTICS -->
<section class="stats">

    <div class="st-card">
        <div class="st-ic g">
            <i class="fas fa-users"></i>
        </div>
        <div class="st-info">
            <div class="st-val" id="sT">0</div>
            <div class="st-lbl">Total</div>
        </div>
    </div>

    <div class="st-card">
        <div class="st-ic c">
            <i class="fas fa-network-wired"></i>
        </div>
        <div class="st-info">
            <div class="st-val" id="sM">0</div>
            <div class="st-lbl">CSI Bound</div>
        </div>
    </div>

    <div class="st-card">
        <div class="st-ic o">
            <i class="fas fa-lock-open"></i>
        </div>
        <div class="st-info">
            <div class="st-val" id="sW">0</div>
            <div class="st-lbl">Wildcard</div>
        </div>
    </div>

    <div class="st-card">
        <div class="st-ic r">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="st-info">
            <div class="st-val" id="sN">0</div>
            <div class="st-lbl">No CSI</div>
        </div>
    </div>

    <div class="st-card">
        <div class="st-ic g">
            <i class="fas fa-sticky-note"></i>
        </div>
        <div class="st-info">
            <div class="st-val" id="sNt">0</div>
            <div class="st-lbl">With Notes</div>
        </div>
    </div>

</section>


<!-- TOOLBAR -->
<section class="toolbar">

    <div class="search">
        <i class="fas fa-search"></i>
        <input id="search"
               placeholder="Search username, MAC, notes...">
    </div>

    <button class="btn btn-p" id="openImport">
        <i class="fas fa-database"></i> Import SQL
    </button>

    <button class="btn" id="exportBtn">
        <i class="fas fa-file-csv"></i> Export CSV
    </button>

    <button class="btn" id="addBtn">
        <i class="fas fa-plus"></i> Add User
    </button>

    <button class="btn btn-r" id="clearBtn">
        <i class="fas fa-trash-alt"></i> Clear All
    </button>

</section>


<!-- FILTERS -->
<section class="filters">

    <button class="pill active" data-filter="all">
        All <span class="pill-cnt" id="fA">0</span>
    </button>

    <button class="pill" data-filter="bound">
        CSI Bound <span class="pill-cnt" id="fB">0</span>
    </button>

    <button class="pill" data-filter="wildcard">
        Wildcard <span class="pill-cnt" id="fW">0</span>
    </button>

    <button class="pill" data-filter="none">
        No CSI <span class="pill-cnt" id="fN">0</span>
    </button>

    <button class="pill" data-filter="notes">
        Has Notes <span class="pill-cnt" id="fNt">0</span>
    </button>

</section>


<!-- USER TABLE -->
<section class="tbl-wrap">

    <div class="tbl-scroll">

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Lastname</th>
                    <th>Firstname</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>MAC Address</th>
                    <th>Notes</th>
                    <th class="nosort">Actions</th>
                </tr>
            </thead>

            <tbody id="tb"></tbody>

        </table>

    </div>

    <div class="tbl-foot">
        <span id="showing">Showing 0</span>
        <div class="pag" id="pagination"></div>
    </div>

</section>


<div class="app-footer">
    RADIUS <span>USER DATABASE</span>
</div>

</main>
</div>


<!-- ADD / EDIT USER MODAL -->
<div class="mo" id="userModal">

    <div class="md">

        <div class="md-h">
            <h2>
                <i class="fas fa-user-edit"></i>
                <span id="modalTitle">Add User</span>
            </h2>

            <button class="mx" data-close="userModal">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="md-b">

            <div class="fg">

                <div class="fgi">
                    <label>Legacy ID</label>
                    <input id="fId" placeholder="Optional">
                </div>

                <div class="fgi">
                    <label>Username *</label>
                    <input id="fUn" placeholder="user@domain">
                </div>

                <div class="fgi">
                    <label>Firstname</label>
                    <input id="fFn">
                </div>

                <div class="fgi">
                    <label>Lastname</label>
                    <input id="fLn">
                </div>

                <div class="fgi">
                    <label>Password</label>
                    <input id="fPw">
                </div>

                <div class="fgi">
                    <label>MAC Address / Wildcard</label>
                    <input id="fCs"
                           placeholder="AA:BB:CC:DD:EE:FF or *">
                    <small>Use * for any MAC address.</small>
                </div>

                <div class="fgi full">
                    <label>Notes</label>
                    <textarea id="fNo"></textarea>
                </div>

            </div>

        </div>

        <div class="md-f">
            <button class="btn" data-close="userModal">Cancel</button>
            <button class="btn btn-p" id="saveUser">Save User</button>
        </div>

    </div>
</div>


<!-- IMPORT SQL FILE MODAL -->
<div class="mo" id="importModal">

    <div class="md lg">

        <div class="md-h">

            <h2>
                <i class="fas fa-database"></i>
                Import SQL Database
            </h2>

            <button class="mx" data-close="importModal">
                <i class="fas fa-times"></i>
            </button>

        </div>


        <div class="md-b">

            <div class="fgi full">

                <label>Select SQL File</label>

                <input
                    type="file"
                    id="sqlFile"
                    accept=".sql"
                    style="width:100%;"
                >

                <div class="sql-hint">
                    Select your exported RADIUS SQL file.
                    Supported tables: radcheck and userinfo.
                </div>

                <div id="selectedFileName"></div>

                <!--
                Hidden compatibility field.
                Existing app.js SQL preview parser can use this value.
                -->
                <textarea
                    id="sqlInput"
                    rows="14"
                    style="display:none;"
                ></textarea>

            </div>


            <div id="importPreview"></div>

        </div>


        <div class="md-f">

            <button class="btn" data-close="importModal">
                Cancel
            </button>

            <button class="btn" id="previewImport">
                <i class="fas fa-eye"></i> Preview
            </button>

            <button class="btn btn-p" id="confirmImport" hidden>
                <i class="fas fa-upload"></i> Import Users
            </button>

        </div>

    </div>
</div>


<!-- NOTES MODAL -->
<div class="mo" id="notesModal">

    <div class="md">

        <div class="md-h">
            <h2 id="notesTitle">Notes</h2>

            <button class="mx" data-close="notesModal">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="md-b">
            <pre id="notesBody"
                 style="white-space:pre-wrap;word-break:break-word"></pre>
        </div>

        <div class="md-f">

            <button class="btn" id="copyNotes">
                Copy Notes
            </button>

            <button class="btn" data-close="notesModal">
                Close
            </button>

        </div>

    </div>
</div>


<!-- CONFIRMATION MODAL -->
<div class="mo" id="confirmModal">

    <div class="md" style="max-width:400px">

        <div class="confirm-d">

            <i class="fas fa-exclamation-triangle"></i>

            <h3 id="confirmTitle">Confirm</h3>

            <p id="confirmText"></p>

            <div class="confirm-a">

                <button class="btn" data-close="confirmModal">
                    Cancel
                </button>

                <button class="btn btn-r" id="confirmAction">
                    Confirm
                </button>

            </div>

        </div>

    </div>
</div>


<!-- TOAST NOTIFICATIONS -->
<div class="toast-c" id="toastContainer"></div>


<!-- SQL FILE READER -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const sqlFile = document.getElementById('sqlFile');
    const sqlInput = document.getElementById('sqlInput');
    const selectedFileName = document.getElementById('selectedFileName');
    const importPreview = document.getElementById('importPreview');
    const confirmImport = document.getElementById('confirmImport');

    if (!sqlFile) return;

    sqlFile.addEventListener('change', function () {

        const file = this.files[0];

        sqlInput.value = '';
        importPreview.innerHTML = '';
        confirmImport.hidden = true;

        if (!file) {
            selectedFileName.textContent = '';
            return;
        }

        if (!file.name.toLowerCase().endsWith('.sql')) {
            alert('Please select a valid SQL file.');
            this.value = '';
            selectedFileName.textContent = '';
            return;
        }

        selectedFileName.textContent =
            'Selected file: ' + file.name;

        const reader = new FileReader();

        reader.onload = function (event) {

            sqlInput.value = event.target.result;

            selectedFileName.textContent =
                'Ready to preview: ' + file.name;

        };

        reader.onerror = function () {

            alert('Unable to read the selected SQL file.');

            sqlFile.value = '';
            selectedFileName.textContent = '';

        };

        reader.readAsText(file);

    });

});
</script>


<!-- MAIN JAVASCRIPT -->
<script src="assets/js/app.js" defer></script>

</body>
</html>
