import { createI18n } from 'vue-i18n';
import ru from '../locales/ru.json';

const messages = {
    ru,
};

const i18n = createI18n({
    locale: 'ru',
    fallbackLocale: 'ru',
    messages,
});

export default i18n;
