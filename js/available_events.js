// available_events.js

async function fetchEvents(url) {
    try {
        const response = await fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                // Add any other headers you need, such as Authorization
            },
        });

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        const data = await response.json();
        return data.data || []; // Sesuaikan dengan struktur respons Anda
    } catch (error) {
        console.error('Failed to fetch events:', error);
        return []; // Kembalikan array kosong jika terjadi kesalahan
    }
}

function populateEventTable(events) {
    const tableBody = document.querySelector('#eventTable tbody');
    tableBody.innerHTML = ''; // Kosongkan baris yang ada

    events.sort((a, b) => a.event_id - b.event_id); // Urutkan berdasarkan event_id

    events.forEach((event, index) => {
        const row = `
            <tr>
                <td>${index + 1}</td>
                <td>${event.title}</td>
                <td>${event.category}</td>
                <td>${event.location}</td>
                <td>${event.date_start} - ${event.date_end}</td>
                <td class="text-center"><a href="#">Cek Event</a></td>
            </tr>
        `;
        tableBody.insertAdjacentHTML('beforeend', row); // Sisipkan baris baru
    });
}
