function getQueryParams() {
    const params = {};
    window.location.search.substring(1).split('&').forEach(param => {
        const [key, value] = param.split('=');
        params[decodeURIComponent(key)] = decodeURIComponent(value || '');
    });
    return params;
}

const params = getQueryParams();
if (params.name) {
    document.querySelector('.name').textContent = params.name;
}
if (params.phone) {
    document.querySelector('.info-container div:nth-child(2)').textContent = params.phone;
}

function formatTime(date) {
    return date.toLocaleTimeString([], {
        hour: '2-digit',
        minute: '2-digit'
    });
}

const now = new Date();
const fromTime = formatTime(now);
const untilTime = formatTime(new Date(now.getTime() + 60 * 60 * 1000));
