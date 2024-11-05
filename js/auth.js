const API_URL = 'http://localhost:80/pbl/api-03/routes'; // Correct URL format

async function login(credentials) {
    const response = await fetch(`${API_URL}/auth.php`, { // Use API_URL here
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(credentials),
    });

    // Check if the response is ok (status in the range 200-299)
    if (!response.ok) {
        const errorResponse = await response.json();
        throw new Error(errorResponse.message || 'Login failed');
    }

    return response.json();
}

async function logout() {
    const response = await fetch(`${API_URL}/auth.php`, { // Use API_URL here
        method: 'DELETE',
        credentials: 'include', // Include cookies if needed
    });

    // Check if the response is ok
    if (!response.ok) {
        const errorResponse = await response.json();
        throw new Error(errorResponse.message || 'Logout failed');
    }

    return response.json();
}
