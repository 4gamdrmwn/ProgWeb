// Fetch & render the Member List asynchronously from data/members.json
async function loadMemberList() {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        await new Promise((resolve) => setTimeout(resolve, 600));

        const res = await fetch("../data/members.json");
        if (!res.ok) {
            throw new Error("Failed to fetch data (status " + res.status + ")");
        }
        const members = await res.json();

        members.forEach(function (member) {
            const tr = document.createElement("tr");
            tr.innerHTML =
                "<td>" + member.member_id + "</td>" +
                "<td>" + member.name + "</td>" +
                "<td>" + member.address + "</td>" +
                "<td>" + member.phone + "</td>" +
                "<td>" +
                "<button type=\"button\">Edit</button> " +
                "<button type=\"button\" class=\"btn-delete\">Delete</button>" +
                "</td>";
            tbody.appendChild(tr);
        });
    } catch (err) {
        tbody.innerHTML =
            "<tr><td colspan=\"5\">Failed to load data: " + err.message + "</td></tr>";
    } finally {
        loading.style.display = "none";
    }
}

document.addEventListener("DOMContentLoaded", loadMemberList);
