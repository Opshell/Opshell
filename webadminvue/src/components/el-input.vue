<template>
    <input
        v-if="disabled"
        :type="type"
        :name="name"
        v-model="rawValue"
        class="input"
        disabled="disabled"
    />
    <input v-else :type="type" :name="name" v-model="rawValue" class="input" />
</template>

<script>
export default {
    name: 'HelloWorld',
    props: {
        type: {
            defualt: 'text',
        },
        name: {},
        value: {},
        placeholder: {},
        disabled: {
            type: Boolean,
            default: false,
        },
    },
    data: function () {
        return {
            rawValue: '',
        }
    },
    mounted: function () {
        let vm = this
        vm.rawValue = vm.value
    },
    watch: {
        rawValue: function (v) {
            this.$emit('input', v)
        },
    },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
input {
    &:-webkit-autofill {
        -webkit-box-shadow: 0 0 0 30px #fcfcfc inset;
    }
    -webkit-autofill: unset;
    font-size: 14px;

    &:focus {
        outline: 0;
    }

    &[type='text'],
    &[type='password'] {
        padding: 0px 5px;
        vertical-align: top;
        border: 1px solid rgba(216, 216, 216, 0.8);
    }

    &[type='radio'],
    &[type='checkbox'] {
        margin-right: 5px;
        cursor: pointer;
        vertical-align: middle;
    }

    &[type='number']::-webkit-inner-spin-button,
    [type='number']::-webkit-outer-spin-button {
        margin: 0;
        -webkit-appearance: none;
    }
    &[type='number'] {
        -moz-appearance: textfield;
    }
}

h3 {
    margin: 40px 0 0;
}
ul {
    list-style-type: none;
    padding: 0;
}
li {
    display: inline-block;
    margin: 0 10px;
}
a {
    color: #42b983;
}
</style>
