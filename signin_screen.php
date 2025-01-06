<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In</title>
  <!-- Link font Inter dari Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cover bg-center h-screen font-['Inter']" style="background-image: url('image/welcome_screen.jpg');">
  <!-- Kontainer utama dengan posisi relatif untuk memastikan overlay ditempatkan dengan benar -->
  <div class="relative flex items-center justify-center h-full">
    
    <!-- Overlay hitam transparan untuk membuat background lebih gelap -->
    <div class="absolute inset-0 bg-black opacity-50"></div>
    
    <!-- Kotak form sign in dengan z-index lebih tinggi agar tampil di depan overlay -->
    <div class="bg-white p-10 rounded-lg shadow-lg w-full max-w-lg relative z-10">
      <h2 class="text-2xl font-bold text-center mb-6">SIGN IN</h2>
      
      <!-- Tambahkan ID "signinForm" di sini -->
      <form id="signinForm">
        <!-- Input untuk Email -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
          <div class="flex items-center border rounded-md px-3 py-2">
            <!-- Icon email -->
            <svg class="w-5 h-5 text-gray-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
              <path d="M21 8v10c0 1.1-.9 2-2 2H5c-1.1 0-2-.9-2-2V8c0-1.1.9-2 2-2h14c1.1 0 2 .9 2 2zM5 8l7 5 7-5H5zm0 10V9.12l7 4.88 7-4.88V18H5z" />
            </svg>
            <input class="appearance-none w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" id="email" type="email" placeholder="Email" />
          </div>
        </div>

        <!-- Input untuk Password -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
          <div class="flex items-center border rounded-md px-3 py-2">
            <!-- Icon password -->
            <svg class="w-5 h-5 text-gray-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2C9.79 2 8 3.79 8 6c0 1.85 1.28 3.41 3 3.86V10H7v10h10V10h-4V9.86c1.72-.45 3-2.01 3-3.86 0-2.21-1.79-4-4-4zm0 7c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" />
            </svg>
            <input class="appearance-none w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" id="password" type="password" placeholder="Password" />
          </div>
        </div>

        <!-- Checkbox untuk "Remember me" -->
        <div class="flex items-center justify-between mb-4">
          <label class="flex items-center">
            <input class="mr-2 leading-tight" type="checkbox" id="rememberMe">
            <span class="text-sm">Remember me</span>
          </label>
        </div>

        <!-- Tombol SIGN IN -->
        <div class="mb-4">
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full" type="submit">SIGN IN</button>
        </div>
      </form>
    </div>
  </div>

  <!-- JavaScript for form submission -->
<script>
// Fungsi untuk mendekode JWT
function parseJwt(token) {
  try {
    const base64Url = token.split('.')[1];
    const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
      return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));

    return JSON.parse(jsonPayload);
  } catch (error) {
    console.error("Error decoding token:", error);
    return null;
  }
}

document.addEventListener('DOMContentLoaded', () => {
    const token = sessionStorage.getItem('token');

    if (token) {
        try {
            const decoded = parseJwt(token);

            // Cek validitas token (opsional: sesuai implementasi backend)
            const isTokenExpired = decoded.exp * 1000 < Date.now();
            if (!isTokenExpired) {
                // Redirect pengguna berdasarkan role atau default
                const roles = decoded.roles || [];
                if (roles.length === 1) {
                    redirectToDashboard(roles[0]);
                } else if (roles.length > 1) {
                    displayRoleButtons(roles); // Jika butuh pemilihan role
                }
                return; // Hentikan eksekusi lebih lanjut
            }
        } catch (e) {
            console.error('Token invalid:', e);
        }
    }

    // Jika tidak ada token valid, tetap di halaman signin
});


document.getElementById('signinForm').addEventListener('submit', async (event) => {
    event.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const rememberMe = document.getElementById('rememberMe').checked;
    const signInButton = event.submitter;

    signInButton.disabled = true;
    signInButton.textContent = 'Signing in...';

    try {
        const response = await fetch('http://localhost/pbl/api-03/routes/auth.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email, password, remember_me: rememberMe }),
        });

        const data = await response.json();

        if (data.status === 'success') {
            const token = data.data.access_token;
            // const token = getCookie('access_token');

            if (rememberMe) {
              // Jika "Remember Me" dicentang, simpan token dan data di sessionStorage
              sessionStorage.setItem('token', token);
              try {
                  const decoded = parseJwt(token);
                  localStorage.setItem('jwt', token);
                  localStorage.setItem('username', decoded.username);
                  localStorage.setItem('roles', JSON.stringify(decoded.roles));

                  const roles = decoded?.roles || [];
                  if (roles.length > 1) {
                      displayRoleButtons(roles);
                  } else if (roles.length === 1) {
                      redirectToDashboard(roles[0]);
                  } else {
                      displayError('No role found.');
                  }
              } catch (e) {
                  displayError('Invalid token format. Please log in again.');
              }
          } else {
              // Jika "Remember Me" tidak dicentang, simpan token dan data di localStorage
              localStorage.setItem('jwt', token);
              try {
                  const decoded = parseJwt(token);
                  localStorage.setItem('username', decoded.username);
                  localStorage.setItem('roles', JSON.stringify(decoded.roles));

                  const roles = decoded?.roles || [];
                  if (roles.length > 1) {
                      displayRoleButtons(roles);
                  } else if (roles.length === 1) {
                      redirectToDashboard(roles[0]);
                  } else {
                      displayError('No role found.');
                  }
              } catch (e) {
                  displayError('Invalid token format. Please log in again.');
              }
          }
        } else {
            displayError(data.message);
        }
    } catch (error) {
        console.error('Error:', error);
        displayError('Login failed. Please try again.');
    } finally {
        signInButton.disabled = false;
        signInButton.textContent = 'SIGN IN';
    }
});


// Fungsi untuk menampilkan tombol untuk memilih role
function displayRoleButtons(roles) {
  const roleSelectionContainer = document.createElement('div');
  roleSelectionContainer.className = 'text-center mt-4';
  roleSelectionContainer.id = 'roleSelectionContainer';

  roles.forEach(role => {
    const button = document.createElement('button');
    button.className = 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2 mx-2';
    button.textContent = role.charAt(0).toUpperCase() + role.slice(1);
    button.addEventListener('click', () => {
      document.getElementById('roleSelectionContainer').remove();
      if (role === 'Admin') {
        alert('Role ini tidak tersedia versi website');
        window.location.reload();
        return;
      } else {
        redirectToDashboard(role);
    }});
    roleSelectionContainer.appendChild(button);
  });

  const form = document.getElementById('signinForm');
  form.appendChild(roleSelectionContainer);
}

// Fungsi untuk mengarahkan pengguna ke dashboard berdasarkan role
function redirectToDashboard(role) {
  const dashboards = {
    Superadmin: 'http://localhost/pbl/web_event_app/superadmin_page/superadmin_dashboard.php',
    Admin: null,
    Propose: 'http://localhost/pbl/web_event_app/propose_page/propose_dashboard.php',
    Member: 'http://localhost/pbl/web_event_app/member_page/member_dashboard.php',
  };

  const dashboardUrl = dashboards[role];
  if (dashboardUrl) {
    window.location.href = dashboardUrl;
  } else {
    displayError(`No dashboard assigned for your role: ${role}`);
  }
}

// Fungsi untuk menampilkan pesan error
function displayError(message) {
  const errorContainer = document.querySelector('#signinForm .text-red-500');
  if (errorContainer) {
    errorContainer.textContent = message;
  } else {
    const newError = document.createElement('div');
    newError.className = 'text-red-500 text-sm mb-4';
    newError.textContent = message;
    const form = document.getElementById('signinForm');
    form.insertBefore(newError, form.firstChild);
  }
}
</script>
</body>
</html>
