const labelMap = {
    0: 'Uncategorized',
    1: 'Academics',
    2: 'Internships',
    3: 'Overseas',
    4: 'Certification',
    5: 'Companies',
    6: 'Interviews',
    7: 'Finances',
    8: 'Health',
    9: 'Lifestyle',
    10: 'Bullying',
    11: 'Family',
    12: 'Friendships',
    13: 'Relationships'
};

let labels = document.getElementsByClassName('label');

for (let i = 0; i < labels.length; i++) {
    labels[i].innerText = labelMap[labels[i].innerText];
}

