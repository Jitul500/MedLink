// ১. ডাটাবেস: ছবির সাথে মিল রেখে নাম, অর্গান এবং রক্তের গ্রুপ সাজানো হয়েছে।
const recipientDatabase = [
    // এগুলো Kidney এবং A+ (অথবা AB+) এর সাথে ম্যাচ করবে, তাই এগুলো সবুজ হবে
    { name: "Sarah Chen", organ: "Kidney", blood: "A+" },
    { name: "Sarah Chen", organ: "Kidney", blood: "A+" }, // ছবিতে ডুপ্লিকেট নাম ছিল
    { name: "Amara Khan", organ: "Kidney", blood: "AB+" },
    { name: "Ennry Larson", organ: "Kidney", blood: "A+" },
    { name: "Amara Khan", organ: "Kidney", blood: "AB+" },
    // এগুলো ম্যাচ করবে না (সাদা থাকবে), কারণ অর্গান বা রক্তের গ্রুপ মিলবে না
    { name: "Mark Watney", organ: "Liver", blood: "O+" },
    { name: "Anathandrson", organ: "Kidney", blood: "O-" }, // A+ ডোনার O- কে দিতে পারে না
    { name: "Mathúzrson", organ: "Heart", blood: "A+" },
];

// ২. মেডিকেল লজিক: রক্তের গ্রুপের মিল
const bloodCompatibilityRules = {
    'O-': ['O-', 'O+', 'A-', 'A+', 'B-', 'B+', 'AB-', 'AB+'],
    'O+': ['O+', 'A+', 'B+', 'AB+'],
    'A-': ['A-', 'A+', 'AB-', 'AB+'],
    'A+': ['A+', 'AB+'], // A+ রক্ত কেবল A+ এবং AB+ রোগীরা নিতে পারে
    'B-': ['B-', 'B+', 'AB-', 'AB+'],
    'B+': ['B+', 'AB+'],
    'AB-': ['AB-', 'AB+'],
    'AB+': ['AB+']
};

// ৩. HTML এলিমেন্টগুলো ধরা
const donorOrganSelect = document.getElementById('donorOrgan');
const donorBloodSelect = document.getElementById('donorBlood');
const findMatchBtn = document.getElementById('findMatchBtn');
const recipientListBody = document.getElementById('recipientListBody');

// ৪. টেবিল রেন্ডার করার ফাংশন
function renderTable(donorOrgan, donorBloodType) {
    // আগের লিস্ট পরিষ্কার করা
    recipientListBody.innerHTML = '';

    recipientDatabase.forEach(recipient => {
        let isMatch = false;

        // ম্যাচিং লজিক চেক করা
        if (donorOrgan && donorBloodType) {
            const organMatch = (recipient.organ === donorOrgan);
            const compatibleTypes = bloodCompatibilityRules[donorBloodType];
            const bloodMatch = compatibleTypes.includes(recipient.blood);

            if (organMatch && bloodMatch) {
                isMatch = true;
            }
        }

        // টেবিলের রো (Row) তৈরি করা
        const row = document.createElement('tr');
        
        // ম্যাচ হলে 'matched-row' ক্লাস যোগ করা (সবুজ হওয়ার জন্য)
        if (isMatch) {
            row.classList.add('matched-row');
        }

        // ছবির মতো নামের ফরম্যাট তৈরি: "Name (Organ, Blood)"
        const displayName = `${recipient.name} (${recipient.organ}, ${recipient.blood})`;
        
        // স্ট্যাটাস ব্যাজ তৈরি (শুধু ম্যাচ হলেই দেখাবে)
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

// ৫. বাটনে ক্লিক করলে কী হবে
findMatchBtn.addEventListener('click', () => {
    const selectedOrgan = donorOrganSelect.value;
    const selectedBlood = donorBloodSelect.value;
    renderTable(selectedOrgan, selectedBlood);
});

// পেজ লোড হওয়ার সাথে সাথেই একবার রান করা, যাতে ছবির মতো ডিফল্ট ভিউ (Kidney, A+) দেখা যায়।
renderTable(donorOrganSelect.value, donorBloodSelect.value);