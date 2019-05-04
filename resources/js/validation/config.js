import vi from 'vee-validate/dist/locale/vi'

let locale = localStorage.getItem('locale');

export default {
    locale: locale,
    dictionary: {
        vi : {
            messages: vi.messages,
        }
    }
}