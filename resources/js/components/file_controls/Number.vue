<template>
    <div id="text-control">
        <b-form-group id="input-group-2" :label="lblName" :label-for="id">
            <vue-tel-input
                :id="id"
                v-model="val"
                :required="isRequired"
                @blur="getInputValue"
            ></vue-tel-input>
        </b-form-group>
    </div>
</template>
<script>
import { VueTelInput } from "vue-tel-input";

export default {
    id: "text-control",
    data() {
        return {
            val: ""
        };
    },
    props: {
        lblName: {
            type: String,
            default: "Name",
            required: true
        },
        id: {
            type: String,
            default: "txt_name"
        },
        isRequired: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        getInputValue() {
            this.$emit("getInputVal", { val: this.val, type: this.lblName });
        }
    },
    components: {
        VueTelInput
    }
};
</script>
