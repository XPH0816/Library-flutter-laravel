import 'package:flutter/material.dart';
import 'package:library_app/Screens/Login/constants.dart';

class RoundedGradientButton extends StatelessWidget {
  final String text, fontfamily;
  final VoidCallback press;
  final double fontsize;
  final Color firstColor, endColor, textColor;

  const RoundedGradientButton({
    Key? key,
    required this.text,
    required this.press,
    this.firstColor = kPrimaryLightColor,
    this.endColor = kPrimaryColor,
    this.textColor = Colors.white,
    this.fontfamily = "SFProText",
    this.fontsize = 16,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    return Container(
        decoration: BoxDecoration(
            borderRadius: BorderRadius.circular(29),
            gradient: LinearGradient(
                begin: Alignment.topCenter,
                end: Alignment.bottomCenter,
                colors: [firstColor, endColor])),
        width: size.width * 0.8,
        child: ClipRRect(
            child: TextButton(
                onPressed: press,
                style: ButtonStyle(
                  padding: MaterialStateProperty.all<EdgeInsets>(
                      EdgeInsets.symmetric(vertical: 20, horizontal: 40)),
                ),
                child: Text(
                  text,
                  style: TextStyle(
                      color: textColor,
                      fontFamily: fontfamily,
                      fontSize: fontsize,
                      fontWeight: FontWeight.bold),
                ))));
  }
}
