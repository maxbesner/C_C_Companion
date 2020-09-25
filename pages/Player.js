export default class Player{
    id;
    name;
    hp;

    constructor(id, name){
        this.id = id;
        this.name = name;
        this.hp = 30;
    }

    incrementHP(){
        return ++hp;
    }

    decrementHP(){
        return --hp;
    }
}