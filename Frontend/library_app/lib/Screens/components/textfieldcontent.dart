import 'package:flutter/material.dart';
import 'package:library_app/Screens/Login/constants.dart';

class TextFieldContent extends StatelessWidget {
  final String fontfamily, hintText;
  final IconData icon;
  final Color textColor;
  final bool obscureText;

  const TextFieldContent({
    Key? key,
    this.fontfamily = "SFProText",
    required this.hintText,
    required this.icon,
    this.textColor = kTextColor,
    this.obscureText = false,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return TextField(
      style: TextStyle(
          fontFamily: fontfamily,
          color: textColor,
          fontWeight: FontWeight.w600),
      decoration: InputDecoration(
          icon: Icon(
            icon,
            color: textColor,
            size: 15,
          ),
          border: InputBorder.none,
          hintText: hintText,
          hintStyle: TextStyle(
              color: textColor,
              fontSize: 15,
              fontFamily: fontfamily,
              fontWeight: FontWeight.w600)),
    );
  }
}
