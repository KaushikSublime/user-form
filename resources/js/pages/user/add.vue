<template>
    <div id="add_user"></div>
</template>
<script>
import { validationMixin } from "vuelidate";
export default {
    id: "add_user",
    data() {
        return {
            user: {
                name: "",
                email: "",
                phone: "",
                address: "",
                zip_code: ""
            }
        };
    }
};
</script>
