<template>
    <div id="text-control">
        <b-form-group id="input-group-2" :label="lblName" :label-for="id">
            <b-form-file
                id="file-default"
                @change="onFileChanged"
            ></b-form-file>
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
        onFileChanged(event) {
            const file = event.target.files[0];
            this.$emit("getInputVal", { val: file, type: this.lblName });
        }
    },
    components: {
        VueTelInput
    }
};
</script>
