jQuery.fn.centerbox = function () {
    this.css("bottom", ((110 - this.height()) / 2) + 5 );
    this.css("text-align", "center");
    return this;
}