<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Admin Dashboard')</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
:root{
  --bg:#f4f6f9;
  --sidebar:#ffffff;
  --card:#ffffff;
  --red:#e63946;
  --text:#1f2933;
  --muted:#6b7280;
  --border:#e5e7eb;
  --graph-bg:#ffe5e5;
  --hover-shadow:0 12px 20px rgba(0,0,0,0.12);
}

*{box-sizing:border-box;}
body{margin:0;font-family:Segoe UI,Arial,sans-serif;background:var(--bg);color:var(--text);}
#menu-toggle{display:none;}

/* ------------------ Sidebar ------------------ */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 220px;
    height: 100vh;
    background: var(--sidebar);
    padding: 20px;
    border-right: 1px solid var(--border);
    transition: left 0.3s;
    z-index: 1000;
    overflow-y: auto;              /* active le scroll vertical */
    -webkit-overflow-scrolling: touch; /* pour smooth scroll sur iOS */
}

.sidebar a {
    display:flex;align-items:center;color:var(--text);text-decoration:none;
    padding:12px;border-radius:10px;margin-bottom:10px;font-weight:500;
    transition:0.3s;
}
.sidebar a i{margin-right:10px;font-size:18px;}
.sidebar a:hover{background:rgba(230,57,70,.12);}

.sidebar-profile {
    display:flex;flex-direction:column;align-items:center;text-align:center;
    margin-bottom:20px;padding-bottom:15px;border-bottom:1px solid var(--border);
}
.sidebar-profile img{
    width:50px;height:50px;border-radius:50%;object-fit:cover;border:2px solid var(--red);margin-bottom:8px;
}
.sidebar-profile h4{margin:3px 0 1px;font-size:13px;font-weight:600;color:var(--text);}

/* ------------------ Main ------------------ */
.main {
    margin-left: 220px; /* laisse la place à la sidebar */
    padding: 20px;
    transition: margin-left 0.3s;
}

/* ------------------ Header ------------------ */
.header {
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
    flex-wrap:wrap;
    gap:10px;
    position: sticky;
    top:0;
    z-index:1100;
    background: var(--bg);
    padding:10px 0;
}
.menu-btn{
    font-size:22px;cursor:pointer;background:var(--red);color:#fff;
    padding:10px 14px;border-radius:10px;
}
.search-bar{flex:1;max-width:300px;}
.search-bar input{width:100%;padding:10px 15px;border-radius:20px;border:1px solid var(--border);outline:none;}

/* ------------------ Cards ------------------ */
.cards{
    display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
    gap:16px;margin-bottom:25px;
}
.card{
    background:var(--card);border-radius:16px;padding:20px;
    box-shadow:0 6px 15px rgba(0,0,0,.06);cursor:pointer;
    display:flex;flex-direction:column;align-items:center;text-align:center;
    transition:0.3s;
}
.card:hover{transform:translateY(-5px);box-shadow:var(--hover-shadow);}
.card i{font-size:28px;color:var(--red);margin-bottom:10px;}
.card h3{margin:0;font-size:14px;color:var(--red);}
.card p{margin:10px 0 0;font-size:30px;font-weight:bold;}

/* ------------------ Graph ------------------ */
.graph-section{display:flex;gap:20px;flex-wrap:wrap;}
.graph-card{
    flex:1;min-width:250px;background:var(--card);border-radius:16px;padding:20px;
    box-shadow:0 6px 15px rgba(0,0,0,.06);
}
.graph-card h2{margin-top:0;color:var(--red);font-size:18px;}
.bar-graph{display:flex;align-items:flex-end;gap:15px;height:180px;margin-top:20px;
    background:var(--graph-bg);border-radius:12px;padding:10px;
}
.bar{width:40px;border-radius:8px 8px 0 0;background:var(--red);
    display:flex;align-items:flex-end;justify-content:center;color:#fff;font-size:12px;font-weight:bold;
}
.bar.cv{height:120px;}
.bar.projects{height:160px;}
.bar.pending{height:80px;}
.graph-labels{display:flex;justify-content:space-around;margin-top:10px;color:var(--muted);}

/* ------------------ Table ------------------ */
.table-wrapper{width:100%;overflow-x:auto;margin-top:25px;}
table{width:100%;border-collapse:collapse;min-width:600px;}
th,td{padding:12px;border-bottom:1px solid var(--border);}
th{color:var(--red);text-align:left;font-weight:500;}
.badge{padding:5px 12px;border-radius:20px;font-size:12px;font-weight:bold;}
.pending{background:#f59e0b;color:#fff;}
.approved{background:#22c55e;color:#fff;}
.rejected{background:#e63946;color:#fff;}
.btn{padding:6px 10px;border-radius:8px;border:none;cursor:pointer;}
.btn-approve{background:#22c55e;color:#fff;}
.btn-reject{background:#e63946;color:#fff;}
td .btn{width:48%;}

@media(max-width:768px){
    td .btn{
        width:100%;
        display:block;
        margin-bottom:6px;
    }
}

@media(max-width:768px){
    .table-wrapper table{
        font-size:14px; /* comme historique */
    }
    .table-wrapper th, .table-wrapper td{
        padding:8px; /* réduire un peu pour mobile */
    }
}


/* ------------------ Profile Dropdown ------------------ */
.profile-menu{position:relative;display:inline-block;}
.profile-menu .avatar{width:40px;height:40px;border-radius:50%;cursor:pointer;}
.profile-menu .dropdown{
    display:none;position:absolute;right:0;top:50px;background:#fff;
    box-shadow:0 4px 15px rgba(0,0,0,0.2);border-radius:10px;
    min-width:150px;z-index:1200;padding:10px 0;
}
.profile-menu .dropdown a,
.profile-menu .dropdown form button{
    display:block;padding:10px 15px;text-decoration:none;color:#333;width:100%;
    text-align:left;border:none;background:none;cursor:pointer;
}
.profile-menu .dropdown.show{display:block;}

/* ------------------ Notifications ------------------ */
.notifications{position:relative;display:inline-block;margin-right:20px;}
.notif-badge{position:absolute;top:-5px;right:-5px;background:var(--red);color:#fff;font-size:12px;padding:3px 6px;border-radius:50%;font-weight:bold;}
.notif-dropdown{display:none;position:absolute;top:30px;right:0;background:#fff;border-radius:8px;
    box-shadow:0 4px 15px rgba(0,0,0,0.2);min-width:250px;max-height:300px;overflow-y:auto;
    z-index:1200;padding:10px 0;
}
.notif-dropdown.show{display:block;}
.notif-item{padding:10px 15px;cursor:pointer;}
.notif-item.unread{font-weight:bold;background:#ffe5e5;}
.notif-item.read{color:#555;}

/* ------------------ Responsive ------------------ */
@media(max-width:768px){
    /* Sidebar mobile */
    .sidebar{left:-220px;transition:left 0.3s;}
    #menu-toggle:checked ~ .sidebar{left:0;}

    /* Main content push */
    .main{margin-left:0;padding:15px;transition:margin-left 0.3s;}
    #menu-toggle:checked ~ .main{margin-left:220px;}

    /* Header sticky */
    .header{/*flex-direction:column;align-items:stretch;*/padding:10px 15px;}

    /* Dropdowns */
    .profile-menu .dropdown,
    .notif-dropdown{z-index:1200;}

    /* Cards / Graphs full width */
    .graph-section{flex-direction:column;}

    /* Table buttons mobile */
    td .btn{width:48%;display:inline-block;margin-bottom:5px;}

    .header{
  display:flex;
  justify-content:space-between;
  align-items:center;
  flex-wrap:wrap; /* ok pour petits écrans si nécessaire */
  gap:10px;
  position:sticky;
  top:0;
  z-index:1100;
  background: var(--bg);
  padding:10px 0;
}

}


</style>






</head>
<body>

<input type="checkbox" id="menu-toggle">

@include('admin.partial.sidebar')

<div class="main">
    @yield('content')
</div>

@yield('scripts')

<script>
// Profile dropdown
document.addEventListener('click', function(e){
    const avatar = document.getElementById('profileAvatar');
    const dropdown = document.getElementById('profileDropdown');
    if(avatar && avatar.contains(e.target)){ dropdown.classList.toggle('show'); }
    else if(dropdown){ dropdown.classList.remove('show'); }
});

// Notifications dropdown
document.addEventListener('DOMContentLoaded', function(){
    const notifIcon = document.getElementById('notifIcon');
    const notifDropdown = document.getElementById('notifDropdown');
    const notifBadge = document.getElementById('notifBadge');
    notifIcon?.addEventListener('click', ()=> notifDropdown.classList.toggle('show'));
    notifDropdown.querySelectorAll('.notif-item.unread').forEach(item=>{
        item.addEventListener('click', async function(){
            const id = this.dataset.id;
            try{
                const token = document.querySelector('meta[name="csrf-token"]').content;
                const res = await fetch(`/notifications/${id}/read`, {
                    method:'POST', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':token}, body:JSON.stringify({})
                });
                const data = await res.json();
                if(data.success){ this.classList.replace('unread','read'); notifBadge.textContent = Math.max(0, parseInt(notifBadge.textContent)-1);}
            }catch(err){console.error(err);}
        });
    });
});
</script>

<script>
document.addEventListener('click', function(e) {
    const btn = e.target.closest('.btn-approve, .btn-reject');
    if (!btn) return;

    const row = btn.closest('tr');
    if (!row || !row.dataset.id) return;

    const id = row.dataset.id;
    const status = btn.classList.contains('btn-approve') ? 'approved' : 'rejected';

    fetch(`/dashboard/request-items/${id}/status`, {
        method: 'PUT', // correspond à ta route Laravel
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ status: status }) // envoi le status au backend
    })
    .then(res => {
        if (!res.ok) throw new Error('Erreur serveur');
        return res.json();
    })
    .then(data => {
        if (data.success) {
            // Animation disparition
            row.style.transition = "opacity 0.5s, transform 0.5s";
            row.style.opacity = 0;
            row.style.transform = "translateX(50px)";
            setTimeout(() => row.remove(), 500);

            // Toast
            const toast = document.createElement('div');
            toast.textContent = "Email envoyé ✅";
            toast.style.cssText = `
                position: fixed;
                bottom: 20px;
                right: 20px;
                background: #22c55e;
                color: #fff;
                padding: 12px 20px;
                border-radius: 10px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.2);
                z-index: 10000;
                opacity: 0;
                transition: opacity 0.5s;
            `;
            document.body.appendChild(toast);
            setTimeout(() => toast.style.opacity = 1, 50);
            setTimeout(() => { toast.style.opacity = 0; setTimeout(() => toast.remove(), 500); }, 2000);
        }
    })
    .catch(err => {
        console.error(err);
        alert("Erreur : email non envoyé");
    });
});
</script>


<script>
// Sidebar toggle - fonctionne PC et mobile
document.addEventListener('DOMContentLoaded', function(){
    const menuBtn = document.querySelector('.menu-btn');
    const sidebar = document.querySelector('.sidebar');
    const main = document.querySelector('.main');

    menuBtn.addEventListener('click', function(){
        if(sidebar.style.left === '0px'){ // sidebar ouverte → fermer
            sidebar.style.left = '-220px';
            main.style.marginLeft = '0';
        } else { // sidebar fermée → ouvrir
            sidebar.style.left = '0';
            main.style.marginLeft = '220px';
        }
    });
});
</script>

</body>
</html>
