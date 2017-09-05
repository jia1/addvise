const labelMap = {
    0: 'Uncategorized',
    1: 'Academics',
    2: 'Internships',
    3: 'Overseas opportunities',
    4: 'Certification',
    5: 'Companies',
    6: 'Interviews',
    7: 'Office politics',
    8: 'Work-life balance',
    9: 'Finances',
    10: 'Health',
    11: 'Lifestyle',
    12: 'Personality',
    13: 'Being different from others',
    14: 'Bullying',
    15: 'Family',
    16: 'Friendships',
    17: 'Relationships'
};

let labels = document.getElementsByClassName('label');

for (let i = 0; i < labels.length; i++) {
    labels[i].innerText = labelMap[labels[i].innerText];
}

