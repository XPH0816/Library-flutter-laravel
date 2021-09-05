import 'package:flutter/material.dart';
import 'package:fdottedline/fdottedline.dart';

class DottedDividerWithText extends StatelessWidget {
  final String text, fontFamily;
  final double spaceBtwScreen, fontSize, spaceBtwText;
  const DottedDividerWithText({
    Key? key,
    required this.text,
    this.fontFamily = "SFProDisplay",
    this.spaceBtwScreen = 30.0,
    this.spaceBtwText = 20.0,
    this.fontSize = 14,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Row(
      children: <Widget>[
        Expanded(
            child: Container(
          margin: EdgeInsets.only(left: spaceBtwScreen, right: spaceBtwText),
          child: FDottedLine(
            color: Colors.white.withOpacity(.45),
            width: 160.0,
          ),
        )),
        Text(
          text,
          style: TextStyle(
              color: Colors.white,
              fontFamily: fontFamily,
              fontSize: fontSize,
              fontWeight: FontWeight.w500),
        ),
        Expanded(
            child: Container(
          margin: EdgeInsets.only(left: spaceBtwText, right: spaceBtwScreen),
          child: FDottedLine(
            color: Colors.white.withOpacity(.45),
            width: 160.0,
          ),
        ))
      ],
    );
  }
}
