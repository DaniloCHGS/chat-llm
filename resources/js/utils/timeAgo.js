import moment from "moment";
import "moment/locale/pt-br";

export function timeAgo(timestamp) {
    return moment.tz(timestamp, "America/Sao_Paulo").fromNow();
}
