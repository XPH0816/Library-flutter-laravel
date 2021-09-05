import 'package:flutter/material.dart';

class TextFieldContainer extends StatelessWidget {
  final Widget child;
  final double spaceBtwEach;
  const TextFieldContainer({
    Key? key,
    required this.child,
    this.spaceBtwEach = 5,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    return Container(
      height: size.height * 0.06,
      margin: EdgeInsets.symmetric(vertical: spaceBtwEach),
      padding: EdgeInsets.symmetric(horizontal: 15, vertical: 5),
      width: size.width * 0.8,
      decoration: BoxDecoration(
          color: Colors.white, borderRadius: BorderRadius.circular(29)),
      child: child,
    );
  }
}
