const API_URL = 'http://localhost:80/pbl/api-03/routes'; 

async function getAllUsers() {
    const response = await fetch(`${API_URL}/users.php`, {
        method: 'GET',
    });

    if (!response.ok) {
        const errorResponse = await response.json();
        throw new Error(errorResponse.message || 'Failed to fetch users');
    }

    return response.json();
}

async function getUserById(userId) {
    const response = await fetch(`${API_URL}/users.php?user_id=${userId}`, {
        method: 'GET',
    });

    if (!response.ok) {
        const errorResponse = await response.json();
        throw new Error(errorResponse.message || `Failed to fetch user with ID ${userId}`);
    }

    return response.json();
}

async function createUser(userData) {
    const response = await fetch(`${API_URL}/users.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(userData),
    });

    if (!response.ok) {
        const errorResponse = await response.json();
        throw new Error(errorResponse.message || 'Failed to create user');
    }

    return response.json();
}

async function updateUser(userId, userData) {
    const response = await fetch(`${API_URL}/users.php?user_id=${userId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(userData),
    });

    if (!response.ok) {
        const errorResponse = await response.json();
        throw new Error(errorResponse.message || `Failed to update user with ID ${userId}`);
    }

    return response.json();
}

async function deleteUser(userId) {
    const response = await fetch(`${API_URL}/users.php?user_id=${userId}`, {
        method: 'DELETE',
    });

    if (!response.ok) {
        const errorResponse = await response.json();
        throw new Error(errorResponse.message || `Failed to delete user with ID ${userId}`);
    }

    return response.json();
}
