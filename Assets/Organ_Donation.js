const bloodCompatibilityRules = {
    'O-': ['O-', 'O+', 'A-', 'A+', 'B-', 'B+', 'AB-', 'AB+'], // Universal Donor
    'O+': ['O+', 'A+', 'B+', 'AB+'],
    'A-': ['A-', 'A+', 'AB-', 'AB+'],
    'A+': ['A+', 'AB+'],
    'B-': ['B-', 'B+', 'AB-', 'AB+'],
    'B+': ['B+', 'AB+'],
    'AB-': ['AB-', 'AB+'],
    'AB+': ['AB+'] 
};


const donorOrganSelect = document.getElementById('donorOrgan');
const donorBloodSelect = document.getElementById('donorBlood');
const findMatchBtn = document.getElementById('findMatchBtn');
const recipientListBody = document.getElementById('recipientListBody');


function renderTable(donorOrgan, donorBloodType) {
    
    recipientListBody.innerHTML = '';

    recipientDatabase.forEach(recipient => {
        let isMatch = false;

        if (donorOrgan && donorBloodType) {

            const organMatch = (recipient.organ_needed === donorOrgan);
            
            const compatibleTypes = bloodCompatibilityRules[donorBloodType];

            const bloodMatch = compatibleTypes.includes(recipient.blood_type);

            if (organMatch && bloodMatch) {
                isMatch = true;
            }
        }

        const row = document.createElement('tr');
        
        if (isMatch) {
            row.classList.add('matched-row');
        }

        const displayName = `${recipient.name} (${recipient.organ_needed}, ${recipient.blood_type})`;

        let statusBadgeHTML = '<span class="empty-status"></span>';
        if (isMatch) {
            statusBadgeHTML = '<span class="badge">Potential Match</span>';
        }

        row.innerHTML = `
            <td>${displayName}</td>
            <td class="status-cell">${statusBadgeHTML}</td>
        `;
        
        recipientListBody.appendChild(row);
    });
}

findMatchBtn.addEventListener('click', () => {
    const selectedOrgan = donorOrganSelect.value;
    const selectedBlood = donorBloodSelect.value;
    renderTable(selectedOrgan, selectedBlood);
});

renderTable(donorOrganSelect.value, donorBloodSelect.value);