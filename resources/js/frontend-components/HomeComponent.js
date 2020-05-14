export default {
    data: () => ({
        show_directions: false,
    }),
    methods: {
        toggleDirections() {
            this.show_directions = !this.show_directions;
        }
    }
}
