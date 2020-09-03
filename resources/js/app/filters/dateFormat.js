export default function (value, formatString) {
    return window.dayjs(value).format(formatString);
};