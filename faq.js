document.addEventListener('DOMContentLoaded', function() {
    // सभी कैटेगरी टैब्स को सेलेक्ट करें
    const categoryTabs = document.querySelectorAll('.sidebarr ul li');
    const faqCategories = document.querySelectorAll('.faq-category');

    // हर कैटेगरी टैब पर क्लिक इवेंट लिसनर जोड़ें
    categoryTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // एक्टिव क्लास को रीमूव करें
            categoryTabs.forEach(t => t.classList.remove('active'));
            faqCategories.forEach(cat => cat.classList.remove('active'));

            // क्लिक की गई कैटेगरी को एक्टिव करें
            tab.classList.add('active');
            const category = tab.getAttribute('data-category');
            document.getElementById(category).classList.add('active');
        });
    });

    // डिटेल्स एलिमेंट्स पर एनिमेशन जोड़ें
    const details = document.querySelectorAll('details');
    details.forEach(detail => {
        detail.addEventListener('toggle', e => {
            if(detail.open) {
                // खुलने पर स्मूथ एनिमेशन
                const summary = detail.querySelector('summary');
                const content = detail.querySelector('p');
                content.style.maxHeight = content.scrollHeight + 'px';
                summary.style.color = '#f98735';
            } else {
                // बंद होने पर एनिमेशन
                const summary = detail.querySelector('summary');
                const content = detail.querySelector('p');
                content.style.maxHeight = '0';
                summary.style.color = '#333';
            }
        });
    });
});