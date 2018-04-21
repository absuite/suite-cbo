import validator from '../../validator';
import { validationMixin } from 'vuelidate'
export default {
  mixins: [validationMixin],
  methods: {
    $validate(input, rules, customMessages) {
      return new validator(input, rules, customMessages);
    },
  },
};